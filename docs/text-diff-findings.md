# Text diff: findings for speedyspec-server

What writing the Text diff seam's pages found in speedyspec-server at commit `219cc61e7a4f` that its compat records
(`compat/text-diff`, which has no `breaks.json`) don't capture. Both were read from the server's source; neither was run
on the guide's runner. When the server records one, update the page it names.

## 1. Row labels are translated once per call

`wp_text_diff()` translates "Added:", "Deleted:" and "Unchanged:" once per call
(`SpeedySpec\WpTextDiff\row_labels()`, `crates/speedyspec-wp-text-diff-php/src/text-diff.php` L70-L88), before it knows
whether the texts differ. WordPress's `WP_Text_Diff_Renderer_Table` calls `__()` once per row
(`wp-includes/class-wp-text-diff-renderer-table.php` L148, L161, L174). A `gettext` filter therefore runs three times
per native call, including for equal texts, instead of once per row. The text is the same unless the filter keeps
state. No test covers the count. Documented on `content/speedyspec/text-diff/_seam.mdx`.

## 2. A huge changed block throws instead of exhausting memory

A changed block of more than 4,000,000 line pairs makes the native `wp_text_diff()` throw an `Error`
(`crates/speedyspec-wp-text-diff/src/table.rs` L21-L26, `port.rs` L74); WordPress runs out of memory there, a fatal
error. Only a unit test in `api.rs` covers it. Documented on `content/speedyspec/text-diff/_seam.mdx`.
