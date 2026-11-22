<?php
// Deprecated in 3.4.0; use wp_get_theme(). Retrieve theme data from parsed theme file. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'get_theme_data', ABSPATH . 'wp-content/themes/index.php' );
