<?php
// Deprecated in 2.0.0; use current_user_can(). Can user can edit other user. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'user_can_edit_user', $f['user'], 1 );
