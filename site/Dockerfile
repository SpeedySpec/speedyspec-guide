# The guide's static site. Build from the repository root (the site reads generated/, seams/ and content/):
#   docker build -f site/Dockerfile .
FROM oven/bun:1.3 AS build
WORKDIR /guide
COPY . .
RUN bun install --frozen-lockfile
# Mermaid diagrams are rendered to SVG at build time in headless Chromium.
RUN bunx playwright install --with-deps chromium
RUN cd site && bun run build

FROM joseluisq/static-web-server:2
COPY --from=build /guide/site/dist /public
EXPOSE 80
CMD ["--port", "80", "--root", "/public"]
