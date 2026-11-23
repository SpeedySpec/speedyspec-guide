<?php
// The radio buttons for an image's size in the old media dialog, each with its dimensions, sizes it doesn't have disabled.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
wp_update_attachment_metadata( $id, array( 'width' => 1200, 'height' => 800, 'file' => '2026/11/lake.jpg', 'sizes' => array() ) );
$fields = image_size_input_fields( get_post( $id ), 'full' );
return array( $fields['label'], str_contains( $fields['html'], '1200&nbsp;&times;&nbsp;800' ) );
