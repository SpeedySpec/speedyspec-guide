<?php
// Ajax handler for the media modal's Insert into post: sends the HTML for an attachment (an image tag, or a link) to put in the classic editor.
$id = wp_insert_attachment( array( 'post_title' => 'Notes', 'post_mime_type' => 'application/pdf' ), '2026/11/notes.pdf' );
$sent = json_decode( guide_ajax( 'wp_ajax_send_attachment_to_editor', array( 'attachment' => array( 'id' => $id, 'post_title' => 'Notes' ), 'nonce' => wp_create_nonce( 'media-send-to-editor' ) ) ), true );
return array( $sent['success'], $sent['data'] );
