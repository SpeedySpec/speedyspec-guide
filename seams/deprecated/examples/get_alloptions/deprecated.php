<?php
// Deprecated in 3.0.0; use wp_load_alloptions(). Retrieve all autoload options, or all options if no autoloaded ones exist. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_alloptions' );
return array( $r[0]['blogname'], $r[1] );
