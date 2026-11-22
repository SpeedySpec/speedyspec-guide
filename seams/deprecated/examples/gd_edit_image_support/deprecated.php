<?php
// Deprecated in 3.5.0; use wp_image_editor_supports(). Check if the installed version of GD supports particular image type. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'gd_edit_image_support', 'image/png' );
