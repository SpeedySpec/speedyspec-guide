<?php
// Updates a comment's fields after filtering them, keeping its approval decided by the moderation checks; 1 on success, 0 when nothing changed, an error for a bad post.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$done = wp_update_comment( array( 'comment_ID' => $c, 'comment_content' => 'Edited' ) );
return array( $done, get_comment( $c )->comment_content, wp_update_comment( array( 'comment_ID' => $c, 'comment_post_ID' => 999 ), true )->get_error_code() );
