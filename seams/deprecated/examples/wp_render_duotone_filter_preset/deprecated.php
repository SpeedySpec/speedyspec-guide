<?php
// Deprecated in 5.9.1; use wp_get_duotone_filter_property(). Renders the duotone filter SVG and returns the CSS filter property to reference the rendered SVG. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_render_duotone_filter_preset', array( 'slug' => 'dark', 'colors' => array( '#000', '#fff' ) ) );
