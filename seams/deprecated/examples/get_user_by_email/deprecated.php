<?php
// Deprecated in 3.3.0; use get_user_by(). Retrieve user info by email. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_user_by_email', 'grace@example.org' );
