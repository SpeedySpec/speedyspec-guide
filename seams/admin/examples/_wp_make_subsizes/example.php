<?php
// Creates the sub-sizes an image is missing, saving its metadata after each in case the server runs out of time; gives the metadata.
$id = guide_image_attachment( 'guide-make', 400, 300 );
$meta = wp_get_attachment_metadata( $id );
$meta['sizes'] = array();
$meta = _wp_make_subsizes( wp_get_registered_image_subsizes(), get_attached_file( $id ), $meta, $id );
$result = array_keys( $meta['sizes'] );
wp_delete_attachment( $id, true );
return $result;
