<?php
// Saves an image editor's image to a file in its MIME type, through image_editor_save_pre and wp_save_image_editor_file; gives the result.
$id = guide_image_attachment( 'guide-savefile', 40, 30 );
$file = dirname( get_attached_file( $id ) ) . '/guide-savefile-copy.png';
$saved = wp_save_image_file( $file, wp_get_image_editor( get_attached_file( $id ) ), 'image/png', $id );
$result = array( $saved['width'], file_exists( $file ) );
unlink( $file );
wp_delete_attachment( $id, true );
return $result;
