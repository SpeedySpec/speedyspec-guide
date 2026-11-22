<?php
// Deprecated in 3.0.0; use delete_user_meta(). Remove user meta data. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'delete_usermeta', $f['user'], 'nickname' );
