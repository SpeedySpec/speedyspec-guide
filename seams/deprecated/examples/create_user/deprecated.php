<?php
// Deprecated in 2.0.0; use wp_create_user(). An alias of wp_create_user(). Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'create_user', 'grace', 'secret', 'grace@example.org' );
