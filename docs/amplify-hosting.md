# Developer site on AWS Amplify

The guide is an Astro static site hosted at `https://developer.speedyspec.dev`.
It does not need a running container, PHP server, or database for serving pages.

## Hosting configuration

- AWS region: `us-east-1`
- Amplify app: `speedyspec-guide` (`d2qtw4dgv5jpua`)
- Platform: `WEB` (static)
- Production branch: `main`
- Default URL: `https://main.d2qtw4dgv5jpua.amplifyapp.com`
- Custom domain: `developer.speedyspec.dev`

The app uses manual artifact deployments rather than Amplify builds. The guide's
existing CI generates reference data using PHP, Rust, and MySQL before building
the static site. Connecting Amplify directly to Git without that generation step
would produce an incomplete build or fail because `generated/` is mostly ignored.

## Build and publish

Use the existing generation pipeline to populate `generated/`, then run:

```bash
bun install --frozen-lockfile
bunx playwright install --with-deps chromium
bun run site:test
bun run site:build
AWS_REGION=us-east-1 bash scripts/deploy-amplify.sh d2qtw4dgv5jpua main
```

The deployment script requires AWS CLI v2 credentials authorized for
`amplify:CreateDeployment`, `amplify:StartDeployment`, and `amplify:GetJob` on this
app's branch and jobs, plus Python 3, curl, and jq. It packages `site/dist/` with
`index.html` at the archive root, uploads it to Amplify, and waits for deployment.
It never includes the PHP/Rust toolchain or source repositories in the upload.

CI saves the complete site, including Pagefind search, as the `developer-site`
artifact after the site tests and build succeed. Download and extract that artifact
into `site/dist/` to publish a CI build without regenerating locally. CI does not
automatically publish; an AWS deployment role must be configured before enabling
that separately. Publish production artifacts from trusted `main` builds.

## Domain and HTTPS

The Amplify domain association maps only the `developer` subdomain to `main`.
It does not change the apex site or other SpeedySpec services. Retrieve the DNS
records Amplify requires with:

```bash
aws amplify get-domain-association --region us-east-1 \
  --app-id d2qtw4dgv5jpua --domain-name speedyspec.dev \
  --query 'domainAssociation.{status:domainStatus,certificate:certificateVerificationDNSRecord,subdomains:subDomains}'
```

At the authoritative DNS provider, add the certificate validation CNAME and the
`developer` routing CNAME returned by AWS. Wait for the domain status to become
`AVAILABLE`, then verify HTTPS and a deep documentation URL. Keep the certificate
validation record for automatic renewal.

The authoritative nameservers were `ns1.vultr.com` and `ns2.vultr.com` when this
app was configured. The initial records returned by Amplify were:

| Type | Name | Target |
| --- | --- | --- |
| CNAME | `_d2438c240144da45bfd823d1cb2443ea` | `_737f51275731b7935eda080d054b6a2e.wzccmgtwzk.acm-validations.aws.` |
| CNAME | `developer` | `d2909eflzzd2ih.cloudfront.net` |

Names above are relative to the `speedyspec.dev` DNS zone. Retrieve fresh values
from AWS before changing DNS if the association has been recreated.

Preserve Astro's directory-based routes and trailing slashes. Do not add an SPA
rewrite to `/index.html`: each guide page has its own generated HTML. The app's
custom rewrite list is empty so unknown paths retain HTTP 404. A `/404.html` page
is included for a useful error document; do not add a wildcard redirect to it,
which returned HTTP 302 in live verification.

## Initial deployment verification

Deployment `1` was published successfully on 2026-11-22. The site test suite passed
132 tests, TypeScript checking passed, and the production build indexed 11,134
pages with Pagefind. Live HTTPS checks verified the homepage, `/guides/`,
`/wordpress/hooks/`, the Pagefind script, and an HTTP 404 for a missing path.
The custom domain remains pending until the Vultr DNS records above are added.
