<?php
// Prints the custom logo.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png', 'guid' => 'http://example.org/wp-content/uploads/icon.png' ), 'icon.png' );
wp_update_attachment_metadata( $icon, array( 'file' => 'icon.png', 'width' => 512, 'height' => 512, 'sizes' => array() ) );
set_theme_mod( 'custom_logo', $icon );
return str_contains( guide_render( 'the_custom_logo' ), 'custom-logo' );
