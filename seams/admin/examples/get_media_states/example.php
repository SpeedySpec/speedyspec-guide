<?php
// The states shown after an attachment's title in the media list: Header Image, Background Image, Site Icon, Logo; filtered by display_media_states.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png' ), '2026/11/icon.png' );
update_option( 'site_icon', $icon );
return get_media_states( get_post( $icon ) );
