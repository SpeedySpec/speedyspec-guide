<?php
// emoji_url and emoji_ext pick the images; ASCII text is returned at once.
function guide_emoji_url( $url ) {
	return 'https://example.com/e/';
}
function guide_emoji_ext( $extension ) {
	return '.gif';
}
add_filter( 'emoji_url', 'guide_emoji_url' );
add_filter( 'emoji_ext', 'guide_emoji_ext' );
return array( wp_staticize_emoji( 'plain' ), wp_staticize_emoji( '🙂' ) );
