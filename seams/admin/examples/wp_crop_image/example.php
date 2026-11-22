<?php
// Crops part of an image file to a size, saving a new file; gives its path or an error.
$id = guide_image_attachment( 'guide-crop', 400, 300 );
$file = wp_crop_image( $id, 0, 0, 200, 200, 100, 100 );
$size = wp_getimagesize( $file );
unlink( $file );
wp_delete_attachment( $id, true );
return array( $size[0], $size[1] );
