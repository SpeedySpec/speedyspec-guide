<?php
// Emails a post's author about a new comment, when the comment is approved and the author is neither the commenter nor the current user; the recipients, text, subject and headers are filtered.
$post = wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish', 'post_author' => 1 ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_content' => 'Nice', 'comment_approved' => 1 ) );
$as_author = wp_notify_postauthor( $comment );
wp_set_current_user( 0 );
return array( $as_author, wp_notify_postauthor( $comment ) );
