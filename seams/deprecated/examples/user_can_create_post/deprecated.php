<?php
// Deprecated in 2.0.0; use current_user_can(). Whether user can create a post. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'user_can_create_post', $f['user'] );
