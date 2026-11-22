<?php
// Sets a post's featured image, by attachment; false when the attachment isn't an image.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( (bool) set_post_thumbnail( $id, $att ), get_post_thumbnail_id( $id ) === $att );
