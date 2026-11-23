#!/usr/bin/env bash
# Publish an already-built static site. Requires AWS CLI v2, Python 3, curl, and jq.
# Usage: bash scripts/deploy-amplify.sh APP_ID [BRANCH]
set -euo pipefail

app_id="${1:?Usage: bash scripts/deploy-amplify.sh APP_ID [BRANCH]}"
branch="${2:-main}"
repo_root="$(cd "$(dirname "$0")/.." && pwd)"
dist="$repo_root/site/dist"
if [[ ! -f "$dist/index.html" || ! -d "$dist/pagefind" ]]; then
  echo 'Build the site and search index first: bun run site:build' >&2
  exit 1
fi

deploy_tmp="$(mktemp -d)"
chmod 700 "$deploy_tmp"
trap 'rm -rf "$deploy_tmp"' EXIT

# The archive must contain index.html at its root, not a surrounding dist/ directory.
python3 - "$dist" "$deploy_tmp/site.zip" <<'PY'
import pathlib
import sys
import zipfile

root = pathlib.Path(sys.argv[1])
with zipfile.ZipFile(sys.argv[2], 'w', zipfile.ZIP_DEFLATED) as archive:
    for path in sorted(root.rglob('*')):
        if path.is_file():
            archive.write(path, path.relative_to(root))
PY

aws amplify create-deployment --app-id "$app_id" --branch-name "$branch" \
  --output json > "$deploy_tmp/deployment.json"
job_id="$(jq -er '.jobId' "$deploy_tmp/deployment.json")"
# Keep the presigned upload URL out of command arguments and terminal output.
jq -er '"url = " + (.zipUploadUrl | @json)' "$deploy_tmp/deployment.json" > "$deploy_tmp/curl.conf"
curl --fail --silent --show-error --retry 3 --request PUT \
  --upload-file "$deploy_tmp/site.zip" --config "$deploy_tmp/curl.conf"
aws amplify start-deployment --app-id "$app_id" --branch-name "$branch" \
  --job-id "$job_id" --query 'jobSummary.{id:jobId,status:status}' --output json

for ((attempt = 0; attempt < 90; attempt++)); do
  status="$(aws amplify get-job --app-id "$app_id" --branch-name "$branch" \
    --job-id "$job_id" --query job.summary.status --output text)"
  case "$status" in
    SUCCEED) echo "Amplify deployment $job_id succeeded."; exit 0 ;;
    FAILED|CANCELLED) echo "Amplify deployment $job_id: $status" >&2; exit 1 ;;
  esac
  sleep 10
done
echo "Deployment $job_id is still pending; inspect it in Amplify before starting another deployment." >&2
exit 1
