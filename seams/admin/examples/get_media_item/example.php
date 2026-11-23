<?php
// The old media dialog's form row for one attachment: its thumbnail, details and fields.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$html = get_media_item( $id );
return array( str_contains( $html, "id='media-head-$id'" ), str_contains( $html, 'Lake' ) );
