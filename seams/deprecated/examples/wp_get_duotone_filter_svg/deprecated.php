<?php
// Deprecated in 6.3.0; use WP_Duotone::get_filter_svg_from_preset(). Returns the duotone filter SVG string for the preset. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_get_duotone_filter_svg', array( 'slug' => 'dark', 'colors' => array( '#000', '#fff' ) ) );
