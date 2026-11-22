<?php
// Deprecated in 6.3.0; use wp_img_tag_add_loading_optimization_attrs(). Adds `loading` attribute to an `img` HTML tag. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_img_tag_add_loading_attr', '<img src="a.jpg" width="10" height="10">', 'the_content' );
