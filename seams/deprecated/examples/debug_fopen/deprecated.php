<?php
// Deprecated in 3.4.0; use error_log(). Open the file handle for debugging. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'debug_fopen', '/dev/null', 'r' );
