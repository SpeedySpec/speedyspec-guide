<?php
// The width and height of an image size from attachment metadata, the full size for full, or false.
$meta = array( 'width' => 1200, 'height' => 800, 'sizes' => array( 'medium' => array( 'width' => 300, 'height' => 200 ) ) );
return array( _wp_get_image_size_from_meta( 'medium', $meta ), _wp_get_image_size_from_meta( 'full', $meta ), _wp_get_image_size_from_meta( 'large', $meta ) );
