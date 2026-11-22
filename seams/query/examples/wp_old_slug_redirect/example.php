<?php
// On a 404 for a post slug, redirects to the post that had that slug or date (stored as _wp_old_slug and _wp_old_date), and stops; old_slug_redirect_url filters the URL.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
wp_update_post( array( 'ID' => $id, 'post_name' => 'hello-again' ) );
add_filter( 'wp_redirect', 'guide_stop_redirect' );
function guide_stop_redirect( $location ) {
	throw new RuntimeException( "redirect to $location" );
}
guide_go( '/hello/' );
try {
	wp_old_slug_redirect();
} catch ( RuntimeException $e ) {
	return array( get_post_meta( $id, '_wp_old_slug' ), $e->getMessage() );
}
