<?php
// Deprecated in 3.0.0; use update_user_meta(). Update metadata of user. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'update_usermeta', $f['user'], 'nickname', 'ada' );
