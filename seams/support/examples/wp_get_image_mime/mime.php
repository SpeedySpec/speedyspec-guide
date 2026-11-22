<?php
// An image file's real MIME type from its contents; false when it isn't an image WordPress knows.
$file = tempnam( sys_get_temp_dir(), 'g' );
file_put_contents( $file, base64_decode( 'R0lGODlhAQABAAAAACw=' ) );
$gif = wp_get_image_mime( $file );
file_put_contents( $file, 'not an image' );
$text = wp_get_image_mime( $file );
unlink( $file );
return array( $gif, $text );
