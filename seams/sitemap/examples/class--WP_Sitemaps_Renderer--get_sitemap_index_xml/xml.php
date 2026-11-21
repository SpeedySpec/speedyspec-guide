<?php
// A sitemapindex of loc and lastmod; other fields are dropped with a notice. The deprecated stylesheet filters still fire, with a notice when hooked.
add_action( 'deprecated_hook_run', fn( $hook ) => print( "deprecated $hook\n" ) );
add_filter( 'deprecated_hook_trigger_error', '__return_false' );
add_filter( 'wp_sitemaps_stylesheet_index_url', fn( $u ) => $u );
return ( new WP_Sitemaps_Renderer() )->get_sitemap_index_xml( array( array( 'loc' => 'http://example.org/?sitemap=posts', 'lastmod' => '2026-01-02' ) ) );
