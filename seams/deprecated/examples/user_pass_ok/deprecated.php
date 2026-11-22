<?php
// Deprecated in 3.5.0; use wp_authenticate(). Check that the user login name and password is correct. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'user_pass_ok', 'admin', 'password' );
