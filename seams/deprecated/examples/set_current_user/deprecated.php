<?php
// Deprecated in 3.0.0; use wp_set_current_user(). Changes the current user by ID or name. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'set_current_user', 1 );
return array( $r[0]->user_login, $r[1] );
