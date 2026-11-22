<?php
// Deprecated in 4.5.0; use wp_get_current_user(). Populate global variables with information about the currently logged in user. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_currentuserinfo' );
return array( $r[0]->user_login, $r[1] );
