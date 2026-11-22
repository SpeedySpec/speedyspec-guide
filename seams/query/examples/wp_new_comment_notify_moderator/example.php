<?php
// Hooked to comment_post: emails the moderators about a pending comment when moderation notification is on.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

update_option( 'moderation_notify', 1 );
wp_set_comment_status( $c, 'hold' );
return wp_new_comment_notify_moderator( $c );
