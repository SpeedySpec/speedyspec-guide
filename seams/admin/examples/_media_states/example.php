<?php
// Prints an attachment's states after its title in the media list.
$icon = wp_insert_attachment( array( 'post_title' => 'Icon', 'post_mime_type' => 'image/png' ), '2026/11/icon.png' );
update_option( 'site_icon', $icon );
return guide_render( fn() => _media_states( get_post( $icon ) ) );
