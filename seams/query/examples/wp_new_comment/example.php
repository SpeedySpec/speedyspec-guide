<?php
// Adds a comment as a submission: fills the author fields, filters it (preprocess_comment), decides its approval, inserts it and fires comment_post; the ID or an error.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$id = wp_new_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Bob', 'comment_author_email' => 'bob@example.org', 'comment_author_url' => '', 'comment_content' => 'Thanks', 'comment_type' => '', 'user_id' => 0 ), true );
return array( get_comment( $id )->comment_content, get_comment( $id )->comment_type, did_action( 'comment_post' ) );
