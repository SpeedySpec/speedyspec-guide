<?php
// Makes a resized copy of an image file beside it and gives its file name, size and MIME type, or false when no resize is needed.
$path = guide_image( 400, 300, 'png' );
$size = image_make_intermediate_size( $path, 200, 200 );
unlink( dirname( $path ) . '/' . $size['file'] );
return array( $size['file'], $size['width'], $size['height'], image_make_intermediate_size( $path, 800, 800 ) );
