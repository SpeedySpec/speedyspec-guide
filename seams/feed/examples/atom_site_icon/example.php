<?php
// Prints the site icon as the Atom feed's icon element, when the site has one.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png' ), '2026/11/icon.png' );
wp_update_attachment_metadata( $icon, array( 'width' => 512, 'height' => 512, 'file' => '2026/11/icon.png', 'sizes' => array() ) );
update_option( 'site_icon', $icon );
return guide_render( 'atom_site_icon' );
