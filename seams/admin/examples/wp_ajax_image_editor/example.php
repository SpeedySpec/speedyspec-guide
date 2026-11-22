<?php
// Ajax handler for the image editor's actions (scale, save, restore, open): applies them and sends back the editor's state.
$upload = wp_upload_dir();
$file = $upload['path'] . '/guide-editor.png';
$image = imagecreatetruecolor( 40, 30 );
imagepng( $image, $file );
$id = wp_insert_attachment( array( 'post_title' => 'Dot', 'post_mime_type' => 'image/png' ), $file );
wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
$sent = guide_ajax( 'wp_ajax_image_editor', array( 'postid' => $id, 'do' => 'open' ), "image_editor-$id" );
wp_delete_attachment( $id, true );
return str_contains( $sent, 'imgedit-panel' );
