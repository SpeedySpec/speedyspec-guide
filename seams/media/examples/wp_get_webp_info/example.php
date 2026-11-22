<?php
// The width, height and kind (lossy, lossless, animated) of a WebP file, read from its header.
$path = guide_image( 40, 30, 'webp' );
return wp_get_webp_info( $path );
