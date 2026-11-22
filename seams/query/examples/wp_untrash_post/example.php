<?php
// Takes a post out of the trash, as a draft by default (wp_untrash_post_status can restore its old status), with its comments; fires untrash_post and untrashed_post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_trash_post( $id );
wp_untrash_post( $id );
return get_post_status( $id );
