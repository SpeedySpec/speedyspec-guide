<?php
// A urlset of loc, lastmod, changefreq and priority; other fields are dropped with a notice. Escaping applies to each value.
function guide_print_doing_it_wrong( $function_name, $message ) {
	print( "$function_name\n" );
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong', 10, 2 );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
return ( new WP_Sitemaps_Renderer() )->get_sitemap_xml( array( array( 'loc' => 'http://example.org/?a=1&b=2', 'lastmod' => '2026-01-02', 'priority' => '0.5', 'image' => 'x' ) ) );
