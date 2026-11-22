<?php
// Hooked to rest_insert_comment: emails the post author about a new note added in the editor.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$note = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'A note', 'comment_type' => 'note', 'user_id' => 2, 'comment_approved' => 1 ) );
return array( wp_new_comment_via_rest_notify_postauthor( get_comment( $note ) ), has_action( 'rest_insert_comment', 'wp_new_comment_via_rest_notify_postauthor' ) );
