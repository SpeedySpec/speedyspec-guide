<?php
// Deprecated in 6.3.0. Parses hex, hsl, and rgb CSS strings using the same regex as TinyColor v1.4.2 used in the JavaScript. Only colors output from react-color are implemented. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_tinycolor_string_to_rgb', '#ff0000' );
