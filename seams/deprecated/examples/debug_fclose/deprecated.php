<?php
// Deprecated in 3.4.0; use error_log(). Close the debugging file handle. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'debug_fclose', false );
