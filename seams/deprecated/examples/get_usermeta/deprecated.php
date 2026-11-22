<?php
// Deprecated in 3.0.0; use get_user_meta(). Retrieve user metadata. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_usermeta', $f['user'] );
