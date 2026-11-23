<?php
// Ajax handler for replying to a comment from the admin: inserts the reply and sends back its row as XML.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
$sent = guide_ajax( fn() => wp_ajax_replyto_comment( 'replyto-comment' ), array( 'comment_post_ID' => $post, 'comment_ID' => $comment, 'content' => 'Thank you!', '_ajax_nonce-replyto-comment' => wp_create_nonce( 'replyto-comment' ) ) );
return array( str_contains( $sent, 'Thank you!' ), get_comments( array( 'parent' => $comment, 'status' => 'all', 'count' => true ) ) );
