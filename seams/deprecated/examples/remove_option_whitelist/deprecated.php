<?php
// Deprecated in 5.5.0; use remove_allowed_options(). Removes a list of options from the allowed options list. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'remove_option_whitelist', array( 'guide' => array( 'guide_option' ) ) );
