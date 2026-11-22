<?php
// The URL of an attachment's thumbnail size, else its full image; false when it has none.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
wp_update_attachment_metadata( $att, array( 'file' => '2026/01/pic.jpg', 'sizes' => array( 'thumbnail' => array( 'file' => 'pic-150x150.jpg', 'width' => 150, 'height' => 150, 'mime-type' => 'image/jpeg' ) ) ) );
return wp_get_attachment_thumb_url( $att );
