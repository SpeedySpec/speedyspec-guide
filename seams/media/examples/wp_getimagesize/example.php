<?php
// PHP's getimagesize() with its warnings silenced, reading WebP, AVIF and HEIC sizes PHP can't.
$path = guide_image( 40, 30, 'png' );
$size = wp_getimagesize( $path );
return array( $size[0], $size[1], $size['mime'] );
