<?php
// Generates and saves an attachment's metadata when it has none and its file exists.
$path = guide_image( 40, 30, 'png' );
$id = wp_insert_attachment( array( 'post_title' => 'Dot', 'post_mime_type' => 'image/png' ), $path );
require_once ABSPATH . 'wp-admin/includes/image.php';
wp_maybe_generate_attachment_metadata( get_post( $id ) );
$meta = wp_get_attachment_metadata( $id );
return array( $meta['width'], $meta['height'] );
