<?php
// Deprecated in 5.5.0; use wp_filter_content_tags(). Filters 'img' elements in post content to add 'srcset' and 'sizes' attributes. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_make_content_images_responsive', '<p>Some <b>content</b>.</p>' );
