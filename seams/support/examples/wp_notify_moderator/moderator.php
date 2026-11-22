<?php
// Emails the site admin (and the author, when they can edit the comment) that a comment waits for moderation, when moderation emails are on.
update_option( 'moderation_notify', 1 );
$post = wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish', 'post_author' => 1 ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_content' => 'Nice', 'comment_approved' => 0 ) );
return wp_notify_moderator( $comment );
