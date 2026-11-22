<?php
// Flips a GD image horizontally, vertically or both. Deprecated in 5.5.0; use WP_Image_Editor::flip().
$flipped = _flip_image_resource( imagecreatetruecolor( 40, 30 ), true, false );
return array( imagesx( $flipped ), imagesy( $flipped ) );
