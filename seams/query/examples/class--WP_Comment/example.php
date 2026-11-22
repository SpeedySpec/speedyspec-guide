<?php
// WP_Comment holds a comment's fields and its children once loaded; a post's fields can be read through it.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
$comment = WP_Comment::get_instance( $c );
return array( $comment->comment_content, $comment->post_title, isset( $comment->post_title ), $comment->get_children(), array_key_exists( 'comment_ID', $comment->to_array() ) );
