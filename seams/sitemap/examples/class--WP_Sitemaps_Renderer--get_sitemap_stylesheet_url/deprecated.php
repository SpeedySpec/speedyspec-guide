<?php
// Deprecated in 7.2.0, when sitemaps lost their XSL stylesheets: the URL methods return ''.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f $v\n" ), 10, 3 );
$renderer = new WP_Sitemaps_Renderer();
return array( $renderer->get_sitemap_stylesheet_url(), $renderer->get_sitemap_index_stylesheet_url() );
