<?php
// Deprecated in 3.5.0; use wp_get_image_editor(). Load an image from a string, if PHP supports it. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_load_image', '/no/such/file.png' );
