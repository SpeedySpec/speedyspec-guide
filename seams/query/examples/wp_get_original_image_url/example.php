<?php
// The URL of an image attachment's original, before it was scaled; filtered by wp_get_original_image_url.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
wp_update_attachment_metadata( $att, array( 'file' => '2026/01/pic-scaled.jpg', 'original_image' => 'pic.jpg' ) );
update_attached_file( $att, '2026/01/pic-scaled.jpg' );
return wp_get_original_image_url( $att );
