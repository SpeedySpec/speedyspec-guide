# Support: findings for speedyspec-server

What writing the Support seam's SpeedySpec pages (the 16 functions the password, crypto, text-diff and media areas
declare) found in speedyspec-server at commit `219cc61e7a4f` that its compat records don't capture. Read from the
server's source and tests, not run on the guide's runner. Differences the Passwords and crypto, Text diff and Media
seams already report are in `docs/password-findings.md`, `docs/text-diff-findings.md` and `docs/media-findings.md`.
When the server records one, update the page it names.

## 1. The added MIME rows change three more functions' answers

`compat/media/DIFFERENCES.md` (L59-L66) records the rows added to `wp_get_mime_types()` and `wp_get_ext_types()`, and
`mime-differences.json` records what that does to `wp_check_filetype_and_ext()`. It names no consequence for the small
functions over those lists, which stay WordPress's own algorithms (`crates/speedyspec-wp-media-php/src/media.php`
L214-L282):

- `wp_ext2type( 'opus' )` is `'audio'` (and `jxl` is `'image'`); WordPress returns `null`. No test covers it.
- `wp_get_default_extension_for_mime_type( 'audio/x-caf' )` is `'caf'`; WordPress returns `false`. Only
  `php::default_extension_unchanged_for_shared_mimes` shows it, as a by-product.
- `wp_check_filetype( 'tone.opus' )` with the default list returns `audio/opus`; WordPress returns `false` for both.

Each follows from the recorded list change. Documented on the three functions' pages under `content/speedyspec/support/`.
