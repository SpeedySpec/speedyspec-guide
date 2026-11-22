<?php
// Deprecated in 6.3.0. Takes input from [0, n] and returns it as [0, 1]. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_tinycolor_bound01', '0.5', 1 );
