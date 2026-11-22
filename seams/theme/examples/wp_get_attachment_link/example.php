<?php
// A link to an attachment's file or page, with its image at a size, an icon, or its title as text; filtered by wp_get_attachment_link.
$att = wp_insert_attachment( array( 'post_title' => 'Photo', 'post_mime_type' => 'image/jpeg', 'post_excerpt' => 'A caption', 'guid' => 'http://example.org/wp-content/uploads/photo.jpg' ), 'photo.jpg' );
wp_update_attachment_metadata( $att, array( 'file' => 'photo.jpg', 'width' => 800, 'height' => 600, 'sizes' => array() ) );
return array( wp_get_attachment_link( $att ), wp_get_attachment_link( $att, 'full', true, false, 'View' ) );
