<?php
// Deprecated in 2.5.0; use wp_signon(). Checks a users login information and logs them in if it checks out. This function is deprecated. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_login', 'admin', 'password' );
