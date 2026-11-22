<?php
// Sends an image editor's image to the browser in its MIME type; gives whether it worked.
$id = guide_image_attachment( 'guide-stream', 40, 30 );
$editor = wp_get_image_editor( get_attached_file( $id ) );
ob_start();
$sent = wp_stream_image( $editor, 'image/png', $id );
$bytes = ob_get_clean();
wp_delete_attachment( $id, true );
return array( $sent, str_starts_with( $bytes, "\x89PNG" ) );
