<?php
// A filter for wp_untrash_post_status that restores a post to the status it had before the trash.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_filter( 'wp_untrash_post_status', 'wp_untrash_post_set_previous_status', 10, 3 );
wp_trash_post( $id );
wp_untrash_post( $id );
return get_post_status( $id );
