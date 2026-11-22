<?php
// Deprecated in 3.3.0. Sanitize every user field. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'sanitize_user_object', get_userdata( 1 ) )[1];
