<?php
// Fires wp_after_insert_post once a post's terms and meta are saved, with whether it was updated and the post before.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$before = did_action( 'wp_after_insert_post' );
wp_after_insert_post( get_post( $id ), true, null );
return did_action( 'wp_after_insert_post' ) - $before;
