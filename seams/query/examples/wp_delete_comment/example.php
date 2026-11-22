<?php
// Trashes a comment, or deletes it with force or when trash is off, with its meta; its children move to its parent. Fires delete_comment and deleted_comment.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_delete_comment( $c );
$trashed = wp_get_comment_status( $c );
wp_delete_comment( $c, true );
return array( $trashed, get_comment( $c ) );
