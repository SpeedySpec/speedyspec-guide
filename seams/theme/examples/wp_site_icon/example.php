<?php
// Hooked to wp_head: prints the site icon's link tags at its sizes; filtered by site_icon_meta_tags.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png', 'guid' => 'http://example.org/wp-content/uploads/icon.png' ), 'icon.png' );
wp_update_attachment_metadata( $icon, array( 'file' => 'icon.png', 'width' => 512, 'height' => 512, 'sizes' => array() ) );
update_option( 'site_icon', $icon );
return substr_count( guide_render( 'wp_site_icon' ), '<link' ) + substr_count( guide_render( 'wp_site_icon' ), '<meta' );
