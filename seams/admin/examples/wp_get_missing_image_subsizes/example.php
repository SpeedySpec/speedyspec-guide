<?php
// The registered image sizes an image attachment should have but doesn't, by name.
$id = guide_image_attachment( 'guide-missing', 400, 300 );
$meta = wp_get_attachment_metadata( $id );
$medium = dirname( get_attached_file( $id ) ) . '/' . $meta['sizes']['medium']['file'];
unset( $meta['sizes']['medium'] );
wp_update_attachment_metadata( $id, $meta );
$result = array_keys( wp_get_missing_image_subsizes( $id ) );
wp_delete_attachment( $id, true );
unlink( $medium );
return $result;
