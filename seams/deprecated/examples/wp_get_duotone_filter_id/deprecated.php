<?php
// Deprecated in 6.3.0. Returns the prefixed id for the duotone filter for use as a CSS id. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_get_duotone_filter_id', array( 'slug' => 'dark', 'colors' => array( '#000', '#fff' ) ) );
