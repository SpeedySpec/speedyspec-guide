<?php
// Marks a comment as spam, remembering its status; fires spam_comment and spammed_comment.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_spam_comment( $c );
return array( wp_get_comment_status( $c ), did_action( 'spammed_comment' ) );
