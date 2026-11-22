<?php
// The EXIF and IPTC data of an image file (camera, aperture, shutter speed, date taken, caption, copyright and the rest), or false; filtered by wp_read_image_metadata.
$id = guide_image_attachment( 'guide-exif', 40, 30 );
$meta = wp_read_image_metadata( get_attached_file( $id ) );
wp_delete_attachment( $id, true );
return array_keys( $meta );
