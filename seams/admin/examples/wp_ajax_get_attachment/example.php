<?php
// Ajax handler for the media modal: sends an attachment's data from wp_prepare_attachment_for_js() as JSON.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$sent = json_decode( guide_ajax( 'wp_ajax_get_attachment', array( 'id' => $id ) ), true );
return array( $sent['success'], $sent['data']['title'] );
