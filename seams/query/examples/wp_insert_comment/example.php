<?php
// Inserts a comment with its fields, defaults filled; updates the post's count and fires wp_insert_comment; the new ID.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$id = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'First' ) );
$comment = get_comment( $id );
return array( $comment->comment_approved, $comment->comment_type, get_comments_number( $post ), did_action( 'wp_insert_comment' ) );
