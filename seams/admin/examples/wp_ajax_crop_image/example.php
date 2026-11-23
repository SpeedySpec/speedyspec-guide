<?php
// Ajax handler for cropping an image in the media modal, such as a site icon or header: makes the cropped copy as a new attachment and sends its data.
$upload = wp_upload_dir();
$file = $upload['path'] . '/guide-crop.png';
$image = imagecreatetruecolor( 40, 30 );
imagepng( $image, $file );
$id = wp_insert_attachment( array( 'post_title' => 'Dot', 'post_mime_type' => 'image/png' ), $file );
wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
$sent = json_decode( guide_ajax( 'wp_ajax_crop_image', array( 'id' => $id, 'context' => 'site-icon', 'cropDetails' => array( 'x1' => 0, 'y1' => 0, 'width' => 30, 'height' => 30, 'dst_width' => 30, 'dst_height' => 30 ), 'nonce' => wp_create_nonce( "image_editor-$id" ) ) ), true );
if ( ! empty( $sent['data']['id'] ) ) {
	wp_delete_attachment( $sent['data']['id'], true );
}
wp_delete_attachment( $id, true );
return $sent['success'];
