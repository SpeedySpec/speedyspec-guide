<?php
// Whether a commenter's new comment comes too soon after their last (15 seconds by default, comment_flood_filter); users who can moderate are never flooding.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_set_current_user( 0 );
$now = current_time( 'mysql', 1 );
return array( wp_check_comment_flood( false, '127.0.0.1', 'ada@example.org', $now, true ), wp_check_comment_flood( false, '10.9.9.9', 'zoe@example.org', $now, true ) );
