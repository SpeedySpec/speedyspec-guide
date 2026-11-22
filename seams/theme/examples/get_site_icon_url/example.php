<?php
// The site icon's URL at a size, or a fallback; filtered by get_site_icon_url.
$none = get_site_icon_url( 512, 'fallback.png' );
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png', 'guid' => 'http://example.org/wp-content/uploads/icon.png' ), 'icon.png' );
wp_update_attachment_metadata( $icon, array( 'file' => 'icon.png', 'width' => 512, 'height' => 512, 'sizes' => array() ) );
update_option( 'site_icon', $icon );
return array( $none, get_site_icon_url() );
