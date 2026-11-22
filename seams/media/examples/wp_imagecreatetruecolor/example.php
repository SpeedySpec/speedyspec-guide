<?php
// Makes a GD true-color image with transparency kept for PNG and GIF output.
$image = wp_imagecreatetruecolor( 40, 30 );
return array( is_gd_image( $image ), imagesx( $image ), imagesy( $image ) );
