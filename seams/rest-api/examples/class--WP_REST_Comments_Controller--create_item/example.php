<?php
// The comments controller: comments at /wp/v2/comments, listed by post, status or author, created by visitors or users, moderated and deleted by users who can.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
[ $status, $comment ] = guide_rest( 'POST', '/wp/v2/comments', array( 'post' => $post, 'content' => 'Nice post' ) );
$hold = guide_rest( 'POST', "/wp/v2/comments/{$comment['id']}", array( 'status' => 'hold' ) )[1]['status'];
wp_set_current_user( 0 );
$visitor = count( guide_rest( 'GET', '/wp/v2/comments', array( 'post' => $post ) )[1] );
return array( $status, $comment['author_name'], $comment['status'], $hold, $visitor );
