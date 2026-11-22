<?php
// Deprecated in 6.6.0; use wp_render_elements_class_name. Updates the block content with elements class names. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_render_elements_support', '<p>x</p>', array( 'blockName' => 'core/paragraph', 'attrs' => array() ) );
