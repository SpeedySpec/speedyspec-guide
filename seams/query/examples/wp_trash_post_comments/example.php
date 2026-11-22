<?php
// Moves a post's comments to post-trashed, remembering each one's status.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
wp_trash_post_comments( $id );
return array( wp_get_comment_status( $c ), get_comment( $c )->comment_approved );
