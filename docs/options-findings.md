# Options: findings for speedyspec-server

Writing the Options seam's pages found these things in speedyspec-server at commit `219cc61e7a4f`. Its compat records
(`compat/options/scenarios.json` and `compat/options/breaks.json`) don't capture them. They come from reading the
server's source next to WordPress trunk `1ccce2133e92` (7.2-RC2), and next to 7.1.4's `option.php`, the nearest tag in
the local clone to the recorded 7.1.5. They haven't been run with the guide's runner. The guide documents each one as it
is today. When the server records or fixes one, update the page it names.

The port followed WordPress 7.1.5 then, and its scenarios and PHPUnit runs were recorded against that release. Findings
1 to 3 were changes 7.2 made to functions the port reimplements.

**Fixed at `786dc5febc75` (speedyspec-server #117):** the server now pins WordPress 7.2-RC2 and follows all three.
`get_option()` untrailingslashes `wp_random_base` (`read.rs` L97), `wp_load_core_site_options()` primes nine names
without `can_compress_scripts` (`network.rs` L16), and `register_setting()`'s defaults end with `show_in_abilities`
(`settings.rs` L189). The pages named below now say works-as-wordpress. Findings 4 to 7 stand.

## 1. `get_option()` doesn't untrailingslash `wp_random_base`

Trunk `option.php` L239 untrailingslashes `wp_random_base` along with `siteurl`, `home`, `category_base` and `tag_base`.
`crates/speedyspec-wp-options/src/read.rs` L92 still lists only the four. A stored `wp_random_base` with a trailing
slash keeps the slash on SpeedySpec. This is documented on `content/speedyspec/options/get_option.mdx`.

## 2. `wp_load_core_site_options()` still primes `can_compress_scripts`

Trunk's `$core_options` (L805) dropped `can_compress_scripts`. `crates/speedyspec-wp-options/src/network.rs` L23 still
lists it, so on multisite SpeedySpec primes one more network option, with one more name in the query. This is
documented on `content/speedyspec/options/wp_load_core_site_options.mdx`.

## 3. `register_setting()` has no `show_in_abilities` default

Trunk adds `'show_in_abilities' => false` to `register_setting()`'s defaults (L3088), and the Abilities API reads it.
SpeedySpec's defaults (`crates/speedyspec-wp-options/src/settings.rs` L182–189) stop at `show_in_rest`, so the entries
of `$wp_registered_settings` and `get_registered_settings()` don't have the key. This is documented on
`content/speedyspec/options/register_setting.mdx`, `get_registered_settings.mdx` and `global/wp_registered_settings.mdx`.

## 4. `$new_allowed_options` and `$new_whitelist_options` exist before any `register_setting()`

At the start of every request, `crates/speedyspec-wp-options-php/src/options.php` L221–226 sets `$new_allowed_options`
to an empty array when it is unset, and makes `$new_whitelist_options` a reference to it. WordPress doesn't touch
either one until the first `register_setting()`. So `isset( $new_allowed_options )` is true on SpeedySpec before then,
and false on WordPress. This is documented on `content/speedyspec/options/global/new_allowed_options.mdx` and
`new_whitelist_options.mdx`.

## 5. No scenario covers three ported symbols

No recorded scenario or WordPress test covers `wp_load_core_site_options()`, the deprecated `setted_site_transient`
action or the `unregister_setting` action. Rust tests on the memory repository cover the first and the third. The guide
calls them works-as-wordpress, or works-with-differences because of finding 2, on the strength of the source and those
tests, and says so on each page.

## 6. Most of the port's PHP checks can't be cited

The guide cites a test as `crate::file::name`. It finds the name as `fn name(` or as `check("name"`.
`crates/speedyspec-wp-options-php/tests/php.rs` runs most of its checks through `yes("name", …)`, for example
`signatures_match_wordpress`, `form_option_escapes` and `register_initial_settings_runs`. `tests/compat.rs` reports
`options_replay_matches` with `println!`. The guide therefore cites the source lines of these checks instead.

## 7. A comment says PHP can override an options handler, but the worker doesn't allow it

`register_options_handlers()` (`crates/speedyspec-wp-options/src/messages.rs` L91) and its network, transient and
settings counterparts say: "PHP overrides one by binding the same key". The worker registers PHP ports only for the
hook store, media, text diff and password (`crates/speedyspec-php-runtime/src/worker.rs` L305–311), and no
`speedyspec-cqrs-php` adapter for the options messages. A PHP object bound under an options key can't be used as the
handler. The architecture page says options can't be replaced from PHP yet.
