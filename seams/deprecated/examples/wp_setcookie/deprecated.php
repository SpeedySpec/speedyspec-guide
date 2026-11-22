<?php
// Deprecated in 2.5.0; use wp_set_auth_cookie(). Sets a cookie for a user who just logged in. This function is deprecated. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_setcookie', 'admin' )[1];
