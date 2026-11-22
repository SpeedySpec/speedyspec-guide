<?php
// Deprecated in 3.4.0. Accepts matches array from preg_replace_callback in wpautop() or a string. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'clean_pre', array( '<pre>a</pre>', 'a' ) );
