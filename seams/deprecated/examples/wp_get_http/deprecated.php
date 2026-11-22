<?php
// Deprecated in 4.4.0; use WP_Http. Perform a HTTP HEAD or GET request. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_get_http', 'https://example.org/feed' );
