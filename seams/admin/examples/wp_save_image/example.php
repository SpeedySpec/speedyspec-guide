<?php
// Saves the image editor's changes to an attachment: a new file for the full size or chosen sizes, keeping the original as a backup; gives a message object.
$id = guide_image_attachment( 'guide-save', 40, 30 );
$_REQUEST = array( 'history' => wp_json_encode( array( array( 'r' => 90 ) ) ), 'target' => 'all', 'context' => '', 'do' => 'save' );
$result = wp_save_image( $id );
$meta = wp_get_attachment_metadata( $id );
$backups = get_post_meta( $id, '_wp_attachment_backup_sizes', true );
foreach ( (array) $backups as $backup ) {
	@unlink( dirname( get_attached_file( $id ) ) . '/' . $backup['file'] );
}
wp_delete_attachment( $id, true );
return array( isset( $result->msg ), $meta['width'], $meta['height'] );
