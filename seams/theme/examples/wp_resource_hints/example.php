<?php
// Hooked to wp_head: prints dns-prefetch and other resource hint link tags for the hosts of enqueued assets; filtered by wp_resource_hints.
add_filter( 'wp_resource_hints', 'guide_hint_cdn', 10, 2 );
function guide_hint_cdn( $urls, $type ) {
	if ( 'preconnect' === $type ) {
		$urls[] = 'https://cdn.example.test';
	}
	return $urls;
}
return guide_render( 'wp_resource_hints' );
