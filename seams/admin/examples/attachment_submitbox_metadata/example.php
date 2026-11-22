<?php
// Prints the attachment edit screen's file details: URL, name, type, size, dimensions and, for audio and video, length and bitrate.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $id, array( 'width' => 1200, 'height' => 800, 'file' => '2026/11/lake.jpg', 'filesize' => 2048, 'sizes' => array() ) );
$GLOBALS['post'] = get_post( $id );
$html = guide_render( 'attachment_submitbox_metadata' );
return array( str_contains( $html, 'lake.jpg' ), str_contains( $html, '1200 by 800' ) );
