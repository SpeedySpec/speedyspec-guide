<?php
// Saves a comment from the comment edit form: author, email, URL, content, status and date; gives the result.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
$_POST = array( 'comment_ID' => $comment, 'comment_post_ID' => $post, 'content' => 'Hello there', 'comment_status' => '1', 'newcomment_author' => 'Ada', 'newcomment_author_email' => 'ada@example.org', 'newcomment_author_url' => '' );
edit_comment();
return get_comment( $comment )->comment_content;
