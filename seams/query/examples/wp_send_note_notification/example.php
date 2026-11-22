<?php
// Emails one user about a note mentioning them, in their locale, linking to the post editor.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$grace = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => 'x', 'role' => 'editor' ) );
$note = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'look', 'comment_type' => 'note', 'user_id' => 1, 'comment_approved' => 1 ) );
return wp_send_note_notification( get_user_by( 'id', $grace ), get_comment( $note ), get_post( $post ) );
