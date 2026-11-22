<?php
// Deprecated in 6.3.0. Rounds and converts values of an RGB object. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_tinycolor_rgb_to_rgb', array( 'r' => 255, 'g' => 0, 'b' => 0 ) );
