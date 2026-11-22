<?php
// The Link URL field and its None, File URL and Attachment Post URL buttons in the old media dialog.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$html = image_link_input_fields( get_post( $id ), 'file' );
return array( str_contains( $html, 'button urlnone' ), str_contains( $html, 'lake.jpg' ) );
