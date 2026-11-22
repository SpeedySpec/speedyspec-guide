<?php
// Whether the site has a custom logo, as the custom_logo theme mod; filtered by has_custom_logo.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png', 'guid' => 'http://example.org/wp-content/uploads/icon.png' ), 'icon.png' );
wp_update_attachment_metadata( $icon, array( 'file' => 'icon.png', 'width' => 512, 'height' => 512, 'sizes' => array() ) );
$before = has_custom_logo();
set_theme_mod( 'custom_logo', $icon );
return array( $before, has_custom_logo() );
