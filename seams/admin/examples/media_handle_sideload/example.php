<?php
// Saves a downloaded file as an attachment of a post, with its metadata; gives the attachment ID or an error.
$upload = wp_upload_dir();
$tmp = wp_tempnam( 'guide-sideload.png' );
imagepng( imagecreatetruecolor( 10, 10 ), $tmp );
$id = media_handle_sideload( array( 'name' => 'guide-sideload.png', 'tmp_name' => $tmp ), 0, 'Dot' );
$result = array( get_the_title( $id ), get_post_mime_type( $id ) );
wp_delete_attachment( $id, true );
return $result;
