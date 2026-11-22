<?php
// An attachment's metadata (sizes, dimensions, file); filtered by wp_get_attachment_metadata unless unfiltered.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
wp_update_attachment_metadata( $att, array( 'width' => 800, 'height' => 600, 'file' => '2026/01/pic.jpg' ) );
return wp_get_attachment_metadata( $att );
