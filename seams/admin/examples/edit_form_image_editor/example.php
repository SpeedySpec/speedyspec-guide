<?php
// Prints the attachment edit screen's main area: the image with its Edit Image button, or the player, and the caption, alt and description fields.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $id, array( 'width' => 1200, 'height' => 800, 'file' => '2026/11/lake.jpg', 'sizes' => array() ) );
$html = guide_render( fn() => edit_form_image_editor( get_post( $id ) ) );
return array( str_contains( $html, 'wp_attachment_holder' ), str_contains( $html, 'attachment_alt' ) );
