<?php
// Saves an attachment's metadata, filtered by wp_update_attachment_metadata; false when it doesn't exist.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( wp_update_attachment_metadata( $att, array( 'width' => 10 ) ), wp_update_attachment_metadata( 999, array() ) );
