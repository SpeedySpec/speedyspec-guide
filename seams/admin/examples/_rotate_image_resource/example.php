<?php
// Rotates a GD image by an angle, as the image editor's preview did. Deprecated in 5.5.0; use WP_Image_Editor::rotate().
$image = imagecreatetruecolor( 40, 30 );
$rotated = _rotate_image_resource( $image, 90 );
return array( imagesx( $rotated ), imagesy( $rotated ) );
