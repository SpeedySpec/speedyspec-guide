<?php
// Ajax handler for Quick Edit of a comment: saves the changes and sends back the updated row as XML.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
guide_ajax( 'wp_ajax_edit_comment', array( 'comment_ID' => $comment, 'content' => 'Lovely tea', '_ajax_nonce-replyto-comment' => wp_create_nonce( 'replyto-comment' ) ) );
return get_comment( $comment )->comment_content;
