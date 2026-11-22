<?php
// Hooked to rest_insert_comment: when a note is created, emails each mentioned user who can see it, except its author and the post author.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$grace = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => 'x', 'role' => 'editor' ) );
$note = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => "<span class=\"wp-note-mention user-$grace\">@grace</span> please look", 'comment_type' => 'note', 'user_id' => 1, 'comment_approved' => 1 ) );
wp_notify_note_mentions( get_comment( $note ), null, true );
return has_action( 'rest_insert_comment', 'wp_notify_note_mentions' );
