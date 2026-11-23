<?php
// Ajax handler for the Featured image box: sets or removes a post's thumbnail and sends back the box's HTML.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$thumb = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $thumb, array( 'width' => 800, 'height' => 600, 'file' => '2026/11/lake.jpg', 'sizes' => array() ) );
guide_ajax( 'wp_ajax_set_post_thumbnail', array( 'post_id' => $post, 'thumbnail_id' => $thumb ), "set_post_thumbnail-$post" );
return get_post_thumbnail_id( $post ) === $thumb;
