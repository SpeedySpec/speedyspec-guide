<?php
// The custom logo image linked to the home page (no link on the front page), or an empty placeholder in the Customizer; filtered by get_custom_logo.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png', 'guid' => 'http://example.org/wp-content/uploads/icon.png' ), 'icon.png' );
wp_update_attachment_metadata( $icon, array( 'file' => 'icon.png', 'width' => 512, 'height' => 512, 'sizes' => array() ) );
set_theme_mod( 'custom_logo', $icon );
$html = get_custom_logo();
return array( str_contains( $html, 'class="custom-logo-link"' ), str_contains( $html, 'icon.png' ) );
