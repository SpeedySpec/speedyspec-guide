<?php
// Deprecated in 2.5.0; use wp_get_attachment_image_src(). Retrieve icon URL and Path. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$r = guide_deprecated( 'get_attachment_icon_src', $f['post'] );
return array( is_array( $r[0] ) ? array_map( fn( $v ) => str_replace( ABSPATH, '', $v ), $r[0] ) : $r[0], $r[1] );
