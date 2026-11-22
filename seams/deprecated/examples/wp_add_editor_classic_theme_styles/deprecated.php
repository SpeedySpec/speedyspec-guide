<?php
// Deprecated in 6.8.0; use wp_enqueue_classic_theme_styles. Loads classic theme styles on classic themes in the editor. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_add_editor_classic_theme_styles', array( 'styles' => array() ) );
