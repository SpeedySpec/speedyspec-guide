<?php
// Creates an image's sub-sizes, scaling down an image larger than big_image_size_threshold first, and saves its metadata as it goes; gives the metadata.
$id = guide_image_attachment( 'guide-subsizes', 400, 300 );
$meta = wp_create_image_subsizes( get_attached_file( $id ), $id );
$result = array_keys( $meta['sizes'] );
wp_delete_attachment( $id, true );
return $result;
