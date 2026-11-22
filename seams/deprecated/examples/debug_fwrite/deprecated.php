<?php
// Deprecated in 3.4.0; use error_log(). Write contents to the file used for debugging. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'debug_fwrite', false, 'x' );
