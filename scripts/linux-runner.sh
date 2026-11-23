#!/usr/bin/env bash
# Runs a command in a Linux musl container, from the repository root, for the runner and the static PHP it embeds.
#
#   scripts/linux-runner.sh bash -c 'cd .cache/speedyspec-server && scripts/build-php.sh'
#   scripts/linux-runner.sh bash -c 'cd runner && cargo test && cargo build --release'
#
# speedyspec-server builds its static PHP for musl, so whatever links it must be built for musl too: on a glibc host
# the link fails on musl-only symbols (issetugid, __flt_rounds). The image is the one speedyspec-server's
# scripts/linux-php.sh uses. The runner comes out fully static, in runner/target/<arch>-unknown-linux-musl/release/,
# and runs on the host (point GUIDE_RUNNER at it).
#
# The repository is mounted at its own path, so the paths php-config records and the runner/server symlink mean the
# same inside and out. The PHP build lives in <server>/.php-build-linux[-arch] on the host, mounted over
# <server>/.php-build, so it never replaces a host build. GUIDE_SERVER_DIR names the server checkout (default: the
# runner/server symlink, else .cache/speedyspec-server). SPEEDYSPEC_LINUX_PLATFORM picks the platform (default: the
# host's architecture). The container is thrown away after each run, so build-php.sh may install missing tools in it.
set -euo pipefail

if [ "$#" -eq 0 ]; then
    echo "usage: scripts/linux-runner.sh <command...>" >&2
    exit 2
fi

root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
if [ -n "${GUIDE_SERVER_DIR:-}" ]; then
    server="$(cd "$GUIDE_SERVER_DIR" && pwd)"
elif [ -e "$root/runner/server" ]; then
    server="$(cd "$root/runner/server" && pwd -P)"
else
    server="$root/.cache/speedyspec-server"
fi
case "$server" in
    "$root"/*) ;;
    *) echo "scripts/linux-runner.sh: the server checkout must be inside $root (it is $server)" >&2; exit 2 ;;
esac

case "$(uname -m)" in
    arm64|aarch64) native="linux/arm64" ;;
    *)             native="linux/amd64" ;;
esac
platform="${SPEEDYSPEC_LINUX_PLATFORM:-$native}"
case "$platform" in
    linux/amd64) rust_target="x86_64-unknown-linux-musl";  suffix="" ;;
    linux/arm64) rust_target="aarch64-unknown-linux-musl"; suffix="-arm64" ;;
    *) echo "scripts/linux-runner.sh: unsupported platform $platform" >&2; exit 2 ;;
esac
php_build_dir="$server/.php-build-linux$suffix"
image="speedyspec-guide-linux:1.99-${platform##*/}"

# Host artifacts (build scripts, proc macros) must link musl dynamically: bindgen dlopen()s libclang, and a static
# musl binary cannot dlopen. CARGO_BUILD_TARGET gives target artifacts `--target` and host ones none, and the rustc
# wrapper turns crt-static off only for invocations without it. Target artifacts, the runner included, stay static.
docker build --quiet --platform "$platform" --tag "$image" - >/dev/null <<'EOF'
FROM rust:1.99-alpine
RUN apk add --no-cache \
    autoconf automake bash binutils bison build-base bzip2 ca-certificates \
    clang-dev cmake curl file flex g++ gettext-dev git gzip jq libtool \
    linux-headers m4 make patch perl pkgconf re2c tar unzip wget xz
RUN printf '%s\n' \
    '#!/bin/sh' \
    'rustc="$1"; shift' \
    'for arg in "$@"; do [ "$arg" = "--target" ] && exec "$rustc" "$@"; done' \
    'exec "$rustc" "$@" -C target-feature=-crt-static' \
    > /usr/local/bin/rustc-host-dynamic \
    && chmod +x /usr/local/bin/rustc-host-dynamic
ENV RUSTC_WRAPPER=/usr/local/bin/rustc-host-dynamic
EOF

mkdir -p "$php_build_dir" "$server/.php-build"

tty_flag=()
if [ -t 0 ] && [ -t 1 ]; then
    tty_flag=(--tty --interactive)
fi

# spc authenticates its GitHub API calls with GITHUB_TOKEN when it is set; passed by name so the value never appears
# in a command line.
token_flags=()
if [ -n "${GITHUB_TOKEN:-}" ]; then
    token_flags=(--env GITHUB_TOKEN)
fi

exec docker run --rm --init ${tty_flag[@]+"${tty_flag[@]}"} \
    --platform "$platform" \
    --volume "$root:$root" \
    --volume "$php_build_dir:$server/.php-build" \
    --volume "speedyspec-guide-registry-${platform##*/}:/usr/local/cargo/registry" \
    ${token_flags[@]+"${token_flags[@]}"} \
    --env CARGO_BUILD_TARGET="$rust_target" \
    --env SPEEDYSPEC_ALLOW_HOST_INSTALL=1 \
    --workdir "$root" \
    "$image" "$@"
