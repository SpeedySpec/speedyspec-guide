<?php
// The HTML the classic editor inserts for an image: the img tag, linked when a URL is given, with a caption shortcode when captioned; filtered by image_send_to_editor.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $id, array( 'width' => 1200, 'height' => 800, 'file' => '2026/11/lake.jpg', 'sizes' => array() ) );
return get_image_send_to_editor( $id, 'A calm lake', 'Lake', 'center', 'http://example.org/lake/', false, 'full', 'A lake' );
