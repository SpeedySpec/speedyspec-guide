<?php
// Remembers a visitor commenter's name, email and URL in cookies for the comment form; not for logged-in users, and with cookie consent only when given.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_set_current_user( 0 );
$sent = array();
add_filter( 'comment_cookie_lifetime', 'guide_cookie_life' );
function guide_cookie_life( $lifetime ) {
	$GLOBALS['guide_lifetime'] = $lifetime;
	return $lifetime;
}
wp_set_comment_cookies( get_comment( $c ), wp_get_current_user(), true );
return $GLOBALS['guide_lifetime'] ?? 'not set';
