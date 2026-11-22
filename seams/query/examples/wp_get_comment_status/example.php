<?php
// A comment's status: approved, unapproved, spam, trash, or false.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Held', 'comment_approved' => 0 ) );
return array( wp_get_comment_status( $c ), wp_get_comment_status( $c + 1 ), wp_get_comment_status( 999 ) );
