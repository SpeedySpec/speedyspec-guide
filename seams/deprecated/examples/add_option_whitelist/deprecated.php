<?php
// Deprecated in 5.5.0; use add_allowed_options(). Adds an array of options to the list of allowed options. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'add_option_whitelist', array( 'guide' => array( 'guide_option' ) ) );
