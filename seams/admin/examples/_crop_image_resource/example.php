<?php
// Crops part of a GD image. Deprecated in 5.5.0; use WP_Image_Editor::crop().
$cropped = _crop_image_resource( imagecreatetruecolor( 40, 30 ), 0, 0, 20, 10 );
return array( imagesx( $cropped ), imagesy( $cropped ) );
