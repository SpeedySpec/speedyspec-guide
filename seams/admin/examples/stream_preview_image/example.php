<?php
// Sends the image editor's preview of an attachment with the pending changes applied, scaled to fit 600 pixels.
$id = guide_image_attachment( 'guide-preview2', 40, 30 );
$_REQUEST['history'] = '';
ob_start();
$sent = stream_preview_image( $id );
$bytes = ob_get_clean();
wp_delete_attachment( $id, true );
return array( $sent, strlen( $bytes ) > 0 );
