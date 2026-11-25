# Admin: findings for speedyspec-server

What writing the Admin seam's SpeedySpec pages (the four native media functions of `wp-admin/includes/media.php`) found
in speedyspec-server at commit `219cc61e7a4f` that its compat records (`compat/media/*differences.json`,
`DIFFERENCES.md`) don't capture. Read from the server's source and tests, not run on the guide's runner. When the server
records it, update the pages it names.

## 1. The metadata filters' `$data` is not getID3's analysis

`wp_read_audio_metadata()` and `wp_read_video_metadata()` pass the `wp_read_audio_metadata` and
`wp_read_video_metadata` filters a fourth argument, `$data`. On WordPress it is getID3's whole `analyze()` result. On
SpeedySpec it is a getID3-shaped view built from the media reader: "the keys WordPress reads from getID3's result, and
the ones plugins commonly read" (`crates/speedyspec-wp-media/src/getid3/mod.rs` L1-L2), plus the reader's neutral
description under `speedyspec` (`functions.rs` L23-L40). A filter that reads any other getID3 key (an MP3's `mpeg`
frame data, `tags_html`, `warning`) finds it missing. The corpus tests compare only the returned metadata, and
`php::filter_sees_four_arguments_and_wins` checks only the argument count and two keys, so no record lists it.
Documented on `content/speedyspec/admin/wp_read_audio_metadata.mdx` and `wp_read_video_metadata.mdx`.
