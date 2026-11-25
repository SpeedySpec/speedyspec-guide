# Media: findings for speedyspec-server

What writing the Media seam's pages found in speedyspec-server at commit `219cc61e7a4f` that its compat records
(`compat/media/*differences.json`, `DIFFERENCES.md`) don't capture. Read from the server's source, not run: the guide's
runner has no media-probe children, so media reads always fail in it. When the server records it, update the page it
names.

## 1. `wp_get_avif_info()` gives up on a stream-wrapper path PHP can't size

The facade (`crates/speedyspec-wp-media-php/src/media.php` L145-L165) takes the AVIF figures from PHP's
`getimagesize()`. When that fails, it reads the file through the media reader, but only for a local path:
`SpeedySpec\WpMedia\local()` is `null` for a stream-wrapper path, and the function returns all `false`. WordPress parses
the file with libavifinfo through `fopen()`, which reads stream wrappers. The image corpus has no file PHP can't size
(no grid AVIF, `compat/media/PROVENANCE.md` L62), so the fallback is never compared. Noted on
`content/speedyspec/media/wp_get_avif_info.mdx`.
