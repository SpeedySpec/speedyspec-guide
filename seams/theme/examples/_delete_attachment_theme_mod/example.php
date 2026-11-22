<?php
// Hooked to delete_attachment: removes the custom logo, header or background theme mods that point at a deleted attachment.
$img = wp_insert_attachment( array( 'post_title' => 'Header', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/header.jpg' ), 'header.jpg' );
wp_update_attachment_metadata( $img, array( 'file' => 'header.jpg', 'width' => 1600, 'height' => 400, 'sizes' => array() ) );
set_theme_mod( 'custom_logo', $img );
_delete_attachment_theme_mod( $img );
return get_theme_mod( 'custom_logo' );
