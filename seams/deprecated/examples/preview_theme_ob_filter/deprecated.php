<?php
// Deprecated in 4.3.0. Callback function for ob_start() to capture all links in the theme. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'preview_theme_ob_filter', '<p>Some <b>content</b>.</p>' );
