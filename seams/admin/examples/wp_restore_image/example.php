<?php
// Restores an attachment's original image from the backup the image editor kept, removing the edited files; gives a message object.
$id = guide_image_attachment( 'guide-restore', 40, 30 );
$_REQUEST = array( 'history' => wp_json_encode( array( array( 'r' => 90 ) ) ), 'target' => 'all', 'context' => '', 'do' => 'save' );
wp_save_image( $id );
$result = wp_restore_image( $id );
$meta = wp_get_attachment_metadata( $id );
wp_delete_attachment( $id, true );
return array( $result->msg ?? $result->error, $meta['width'], $meta['height'] );
