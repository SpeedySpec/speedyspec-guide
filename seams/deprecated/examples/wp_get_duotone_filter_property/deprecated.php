<?php
// Deprecated in 6.3.0. Returns the CSS filter property url to reference the rendered SVG. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_get_duotone_filter_property', array( 'slug' => 'dark', 'colors' => array( '#000', '#fff' ) ) );
