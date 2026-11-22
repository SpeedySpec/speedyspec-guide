<?php
// Sets a comment's status (hold, approve, spam, trash), updating counts and firing wp_set_comment_status; true, false or an error.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$held = wp_set_comment_status( $c, 'hold' );
return array( $held, wp_get_comment_status( $c ), wp_set_comment_status( $c, 'nope' ) );
