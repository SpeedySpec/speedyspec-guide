<?php
// The HTML another site embeds a post with: a blockquote link and a sandboxed iframe sharing a random secret, then the embed script; embed_html filters it.
function guide_secret_password( $password ) {
	return 'SECRET';
}
add_filter( 'random_password', 'guide_secret_password' );
$html = get_post_embed_html( 600, 400, guide_post() );
return array( substr( $html, 0, strpos( $html, '<script' ) ?: strlen( $html ) ), get_post_embed_html( 600, 400, 999 ) );
