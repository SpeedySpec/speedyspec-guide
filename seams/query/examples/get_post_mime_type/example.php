<?php
// A post's MIME type, or false.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( get_post_mime_type( $att ), get_post_mime_type( 999 ) );
