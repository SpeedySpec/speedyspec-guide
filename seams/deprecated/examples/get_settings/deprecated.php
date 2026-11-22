<?php
// Deprecated in 2.1.0; use get_option(). Get value based on option. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_settings', 'blogname' );
