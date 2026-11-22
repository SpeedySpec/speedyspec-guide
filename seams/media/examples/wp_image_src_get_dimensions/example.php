<?php
// The width and height of an image source URL, found in the attachment's metadata, or false.
$id = guide_attachment();
$meta = wp_get_attachment_metadata( $id );
return array( wp_image_src_get_dimensions( wp_get_attachment_image_url( $id, 'medium' ), $meta, $id ), wp_image_src_get_dimensions( 'http://example.org/other.jpg', $meta, $id ) );
