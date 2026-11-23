<?php
// Hooked to media_send_to_editor: gives the image HTML for an attachment inserted from the old media dialog.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $id, array( 'width' => 1200, 'height' => 800, 'file' => '2026/11/lake.jpg', 'sizes' => array() ) );
return image_media_send_to_editor( '', $id, array( 'post_excerpt' => '', 'url' => '', 'align' => 'none', 'image-size' => 'full', 'image_alt' => 'A lake' ) );
