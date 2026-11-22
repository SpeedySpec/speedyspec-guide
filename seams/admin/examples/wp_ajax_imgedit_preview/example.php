<?php
// Ajax handler that streams a preview of an image with the image editor's pending changes.
$upload = wp_upload_dir();
$file = $upload['path'] . '/guide-preview.png';
$image = imagecreatetruecolor( 40, 30 );
imagepng( $image, $file );
$id = wp_insert_attachment( array( 'post_title' => 'Dot', 'post_mime_type' => 'image/png' ), $file );
wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
$sent = guide_ajax( 'wp_ajax_imgedit_preview', array( 'postid' => $id ), "image_editor-$id" );
wp_delete_attachment( $id, true );
return str_starts_with( $sent, "\x89PNG" );
