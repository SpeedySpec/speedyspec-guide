<?php
// A comment as a WP_Comment, array or list, by ID or object; the global comment when empty; filtered by get_comment.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$comment = get_comment( $c );
return array( get_class( $comment ), $comment->comment_author, get_comment( $c, ARRAY_A )['comment_content'], get_comment( 999 ) );
