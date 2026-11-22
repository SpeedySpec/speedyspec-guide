<?php
// Deprecated in 3.5.0; use get_post(). Retrieve a single post, based on post ID. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'wp_get_single_post', $f['post'] );
return array( $r[0]->post_title, $r[1] );
