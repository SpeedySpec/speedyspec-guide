<?php
// The width, height, bit depth and channel count of an AVIF file, read with the bundled AVIF parser, or false values for other files.
$path = guide_image( 40, 30, 'png' );
return wp_get_avif_info( $path );
