<?php
// Deprecated in 7.2.0. Adds crossorigin="anonymous" to relevant tags in the given HTML string. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_add_crossorigin_attributes', '<script src="https://cdn.example/a.js"></script>' );
