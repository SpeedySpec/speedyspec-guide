<?php
// Deprecated in 6.1.0; use wp_style_engine_get_styles(). Generates an inline style for a typography feature e.g. text decoration, text transform, and font style. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_typography_get_css_variable_inline_style', array(), 'fontSize', 'font-size' );
