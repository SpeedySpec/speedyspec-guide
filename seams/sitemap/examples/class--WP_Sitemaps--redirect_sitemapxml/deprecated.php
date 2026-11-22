<?php
// Deprecated in 6.7.0; a bypass already set is returned as it is.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	print( "$function_name $version\n" );
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
return ( new WP_Sitemaps() )->redirect_sitemapxml( true, null );
