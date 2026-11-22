<?php
// Restores a post's trashed comments to their earlier statuses.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
wp_trash_post_comments( $id );
wp_untrash_post_comments( $id );
return get_comment( $c )->comment_approved;
