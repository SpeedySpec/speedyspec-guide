<?php
// Deprecated in 7.2.0: the stylesheet methods return ''; render_stylesheet() answers 410 Gone and exits.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	print( "$function_name $version\n" );
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
$stylesheet = new WP_Sitemaps_Stylesheet();
return array( $stylesheet->get_sitemap_stylesheet(), $stylesheet->get_sitemap_index_stylesheet(), $stylesheet->get_stylesheet_css() );
