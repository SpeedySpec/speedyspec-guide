<?php
// Hooked to wp_head: prints preload link tags for the resources the wp_preload_resources filter gives.
add_filter( 'wp_preload_resources', 'guide_preload_font' );
function guide_preload_font( $resources ) {
	$resources[] = array( 'href' => 'https://example.org/font.woff2', 'as' => 'font', 'type' => 'font/woff2', 'crossorigin' => '' );
	return $resources;
}
return guide_render( 'wp_preload_resources' );
