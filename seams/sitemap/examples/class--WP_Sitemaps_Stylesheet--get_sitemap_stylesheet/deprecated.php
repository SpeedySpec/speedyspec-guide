<?php
// Deprecated in 7.2.0: the stylesheet methods return ''; render_stylesheet() answers 410 Gone and exits.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f $v\n" ), 10, 3 );
$stylesheet = new WP_Sitemaps_Stylesheet();
return array( $stylesheet->get_sitemap_stylesheet(), $stylesheet->get_sitemap_index_stylesheet(), $stylesheet->get_stylesheet_css() );
