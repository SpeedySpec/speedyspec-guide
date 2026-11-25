# Cron: findings for speedyspec-server

What writing the Cron seam's pages found in speedyspec-server at commit `219cc61e7a4f` that its compat records
(`compat/cron/scenarios.json`, `compat/cron/breaks.json`) don't capture. These were read from the server's source and
its own tests, not run with the guide's runner (the Cron seam has no runtime examples yet). The guide documents each as
it is today; when the server records or fixes one, update the page it names.

## 1. `spawn_cron()` sends no request, and no scenario records it

`crates/speedyspec-wp-cron-php/src/cron.php` L306–342: when WordPress's checks pass, SpeedySpec sets `doing_cron`,
filters `cron_request` (and `https_local_ssl_verify`) with WordPress's array, then returns `true` without sending it;
the native side reports a wake time of now so the server calls its cron endpoint. WordPress posts the filtered request
with `wp_remote_post()` (`wp-includes/cron.php` L1012–1014). With `ALTERNATE_WP_CRON`, WordPress redirects the visitor
and runs `wp-cron.php` in the same request (L950–968); SpeedySpec ignores the constant here. None of the 106 cron
scenarios calls `spawn_cron()`, `wp_cron()` or `_wp_cron()`, and `breaks.json` lists none of this. The server's own
check is `spawn_cron_sends_nothing` in `crates/speedyspec-wp-cron-php/tests/php.rs` L232–242. Documented on
`content/speedyspec/cron/spawn_cron.mdx`, `_wp_cron.mdx`, `filter/cron_request.mdx` and
`filter/https_local_ssl_verify.mdx` as differences.

## 2. A write can fail with `could_not_set` where WordPress writes

Every cron write is a compare-and-swap, retried up to five times (`crates/speedyspec-wp-cron/src/write.rs` L17–18,
L123–126). After five conflicts the function returns `could_not_set` (or `false`); WordPress would overwrite the other
process's change and return `true`. This is a deliberate design choice (crate docs), tested by
`speedyspec-wp-cron::write::five_conflicts_give_could_not_set`, but no compat break records it, since the recorder runs
one process. Documented on the six write functions' pages as a difference.

## 3. `wp-cron.php` answers 404

A prepared release replaces `wp-cron.php` with `crates/speedyspec-wp-cron-php/src/wp-cron-stub.php`, which answers 404.
Monitoring or external cron jobs that request `wp-cron.php` stop running events. Not in the compat records. Documented
on `content/speedyspec/cron/_seam.mdx` and `spawn_cron.mdx`.

## 4. A stale comment in `compat/cron/setup.php`

L366 says the port's release copy keeps `spawn_cron()`, `wp_cron()` and `_wp_cron()`, but `PORTED_FUNCTIONS`
(`crates/speedyspec-wp-cron-php/src/release.rs` L18–37) strips them too, and SpeedySpec's `cron.php` declares them.
The scenarios don't call them, so the replay is unaffected.
