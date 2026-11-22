<?php
// Handles a comment form submission: checks the post is open and readable, the fields required and their lengths, then wp_new_comment(); the comment or an error.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

wp_set_current_user( 0 );
$missing = wp_handle_comment_submission( array( 'comment_post_ID' => $post, 'comment' => 'Hi' ) );
$ok = wp_handle_comment_submission( array( 'comment_post_ID' => $post, 'comment' => 'Hi', 'author' => 'Bob', 'email' => 'bob@example.org' ) );
return array( $missing->get_error_code(), get_class( $ok ), $ok->comment_author );
