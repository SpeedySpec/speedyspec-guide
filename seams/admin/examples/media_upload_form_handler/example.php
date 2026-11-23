<?php
// Saves the old media dialog's form: each attachment's fields, then inserts one into the editor or saves the gallery.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$_POST = array( 'attachments' => array( $id => array( 'post_title' => 'Mountain lake' ) ), '_wpnonce' => wp_create_nonce( 'media-form' ) );
$_REQUEST = $_POST;
media_upload_form_handler();
return get_the_title( $id );
