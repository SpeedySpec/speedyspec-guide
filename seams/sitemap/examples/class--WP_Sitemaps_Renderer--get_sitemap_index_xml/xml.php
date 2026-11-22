<?php
// A sitemapindex of loc and lastmod; other fields are dropped with a notice. The deprecated stylesheet filters still fire, with a notice when hooked.
function guide_print_deprecated_hook( $hook ) {
	print( "deprecated $hook\n" );
}
add_action( 'deprecated_hook_run', 'guide_print_deprecated_hook' );
add_filter( 'deprecated_hook_trigger_error', '__return_false' );
function guide_keep_stylesheet_url( $url ) {
	return $url;
}
add_filter( 'wp_sitemaps_stylesheet_index_url', 'guide_keep_stylesheet_url' );
return ( new WP_Sitemaps_Renderer() )->get_sitemap_index_xml( array( array( 'loc' => 'http://example.org/?sitemap=posts', 'lastmod' => '2026-01-02' ) ) );
