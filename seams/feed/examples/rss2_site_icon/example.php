<?php
// Prints the site icon as the RSS feed's image element, with the site's title and link, when the site has one.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png' ), '2026/11/icon.png' );
wp_update_attachment_metadata( $icon, array( 'width' => 512, 'height' => 512, 'file' => '2026/11/icon.png', 'sizes' => array() ) );
update_option( 'site_icon', $icon );
update_option( 'blogname', 'Tea Notes' );
return guide_render( 'rss2_site_icon' );
