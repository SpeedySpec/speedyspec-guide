<?php
// An attachment's URL from its file under the uploads URL, else its guid; HTTPS when the request is; filtered by wp_get_attachment_url.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return wp_get_attachment_url( $att );
