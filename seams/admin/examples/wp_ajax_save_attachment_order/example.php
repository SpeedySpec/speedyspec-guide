<?php
// Ajax handler that saves the order of a gallery's attachments as their menu order.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$a = wp_insert_attachment( array( 'post_title' => 'A', 'post_mime_type' => 'image/jpeg', 'post_parent' => $post ), 'a.jpg' );
$b = wp_insert_attachment( array( 'post_title' => 'B', 'post_mime_type' => 'image/jpeg', 'post_parent' => $post ), 'b.jpg' );
guide_ajax( 'wp_ajax_save_attachment_order', array( 'post_id' => $post, 'attachments' => array( $a => 2, $b => 1 ), 'nonce' => wp_create_nonce( "update-post_$post" ) ) );
return array( get_post( $a )->menu_order, get_post( $b )->menu_order );
