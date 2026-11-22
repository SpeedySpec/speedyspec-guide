<?php
// Deprecated in 6.3.0. Converts an HSL object to an RGB object with converted and rounded values. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_tinycolor_hsl_to_rgb', array( 'h' => 0, 's' => 1, 'l' => 0.5 ) );
