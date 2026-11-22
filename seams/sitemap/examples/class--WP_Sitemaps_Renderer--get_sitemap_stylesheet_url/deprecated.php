<?php
// Deprecated in 7.2.0, when sitemaps lost their XSL stylesheets: the URL methods return ''.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	print( "$function_name $version\n" );
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
$renderer = new WP_Sitemaps_Renderer();
return array( $renderer->get_sitemap_stylesheet_url(), $renderer->get_sitemap_index_stylesheet_url() );
