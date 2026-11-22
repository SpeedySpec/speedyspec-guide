<?php
// Deprecated in 3.0.0; use count_user_posts(). Retrieves the number of posts a user has written. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_usernumposts', $f['user'] );
