<?php
// Ajax handler for editing an attachment's title, caption, description and alt text in the media modal.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
guide_ajax( 'wp_ajax_save_attachment', array( 'id' => $id, 'changes' => array( 'title' => 'Mountain lake', 'alt' => 'A lake' ), 'nonce' => wp_create_nonce( "update-post_$id" ) ) );
return array( get_the_title( $id ), get_post_meta( $id, '_wp_attachment_image_alt', true ) );
