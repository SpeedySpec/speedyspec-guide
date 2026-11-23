<?php
// Creates the sub-sizes an image attachment is missing; gives its metadata or an error.
$id = guide_image_attachment( 'guide-update', 400, 300 );
$meta = wp_get_attachment_metadata( $id );
unset( $meta['sizes']['medium'] );
wp_update_attachment_metadata( $id, $meta );
$meta = wp_update_image_subsizes( $id );
$result = isset( $meta['sizes']['medium'] );
wp_delete_attachment( $id, true );
return $result;
