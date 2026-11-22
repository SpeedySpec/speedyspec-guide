<?php
// Takes a comment out of the trash, back to its status before.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_trash_comment( $c );
wp_untrash_comment( $c );
return wp_get_comment_status( $c );
