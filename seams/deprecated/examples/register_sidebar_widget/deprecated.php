<?php
// Deprecated in 2.8.0; use wp_register_sidebar_widget(). Register widget for sidebar with backward compatibility. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'register_sidebar_widget', 'guide', '__return_null' );
