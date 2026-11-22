<?php
// Ajax handler for the extra attachment fields plugins add to the media modal with attachment_fields_to_edit; saves them through attachment_fields_to_save.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$sent = json_decode( guide_ajax( 'wp_ajax_save_attachment_compat', array( 'id' => $id, 'attachments' => array( $id => array( 'post_title' => 'Mountain lake' ) ), 'nonce' => wp_create_nonce( "update-post_$id" ) ) ), true );
return array( $sent['success'], get_the_title( $id ) );
