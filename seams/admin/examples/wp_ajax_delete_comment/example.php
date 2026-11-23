<?php
// Ajax handler that trashes, spams, restores or deletes a comment from the comments list, and sends back the new counts as XML.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
$sent = guide_ajax( 'wp_ajax_delete_comment', array( 'id' => $comment, 'trash' => '1', '_total' => 1, '_per_page' => 20, '_page' => 1, '_url' => admin_url( 'edit-comments.php' ) ), "delete-comment_$comment" );
return array( str_contains( $sent, '<wp_ajax>' ), wp_get_comment_status( $comment ) );
