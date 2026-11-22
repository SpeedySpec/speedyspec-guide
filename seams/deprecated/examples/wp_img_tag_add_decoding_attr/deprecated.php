<?php
// Deprecated in 6.4.0; use wp_img_tag_add_loading_optimization_attrs(). Adds `decoding` attribute to an `img` HTML tag. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_img_tag_add_decoding_attr', '<img src="a.jpg" width="10" height="10">', 'the_content' );
