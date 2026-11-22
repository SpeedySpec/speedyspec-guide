<?php
// Deprecated in 3.3.0; use get_user_by(). Retrieve user info by login name. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_userdatabylogin', 'admin' );
return array( $r[0]->ID, $r[1] );
