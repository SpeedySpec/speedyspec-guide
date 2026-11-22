<?php
// Whether a value is a GD image: a GdImage object, or a gd resource on old PHP.
return array( is_gd_image( imagecreatetruecolor( 2, 2 ) ), is_gd_image( 'image.png' ) );
