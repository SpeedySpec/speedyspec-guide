<?php
// The MIME types attachments (or posts of a type) have, cached; filtered by pre_get_available_post_mime_types.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return get_available_post_mime_types();
