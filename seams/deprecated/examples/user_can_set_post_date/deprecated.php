<?php
// Deprecated in 2.0.0; use current_user_can(). Whether user can set new posts' dates. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'user_can_set_post_date', $f['user'] );
