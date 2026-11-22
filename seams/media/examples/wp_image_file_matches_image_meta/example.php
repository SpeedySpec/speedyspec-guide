<?php
// Whether an image URL or path is one of the files in an attachment's metadata; filtered by wp_image_file_matches_image_meta.
$id = guide_attachment();
$meta = wp_get_attachment_metadata( $id );
return array( wp_image_file_matches_image_meta( wp_get_attachment_image_url( $id, 'medium' ), $meta ), wp_image_file_matches_image_meta( 'http://example.org/other.jpg', $meta ) );
