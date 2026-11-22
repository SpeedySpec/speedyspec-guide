<?php
// Deprecated in 5.5.0; use _wp_register_meta_args_allowed_list(). Filters out `register_meta()` args based on an allowed list. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_wp_register_meta_args_whitelist', array(), array( 'type' => '' ) );
