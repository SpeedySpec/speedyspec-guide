<?php
// Ajax handler for the Comments box on the post screen: sends a page of a post's comments as list table rows.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
$sent = guide_ajax( fn() => wp_ajax_get_comments( 'get-comments' ), array( 'p' => $post, 'mode' => 'single' ), 'get-comments' );
return array( str_contains( $sent, '<wp_ajax>' ), str_contains( $sent, 'Lovely' ) );
