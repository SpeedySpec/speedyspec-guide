<?php
// Ajax handler that approves or unapproves a comment from the comments list, and sends back the new counts as XML.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 0 ) );
guide_ajax( 'wp_ajax_dim_comment', array( 'id' => $comment, 'new' => 'approved', '_total' => 1, '_per_page' => 20, '_page' => 1, '_url' => admin_url( 'edit-comments.php' ) ), "approve-comment_$comment" );
return wp_get_comment_status( $comment );
