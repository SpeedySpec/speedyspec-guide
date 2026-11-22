<?php
// Loads an image with GD: its size and type, and the default quality; a missing file or one that isn't an image is an error.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
return array( WP_Image_Editor_GD::test(), WP_Image_Editor_GD::supports_mime_type( 'image/png' ), $editor->load(), $editor->get_size(), $editor->get_quality(), ( new WP_Image_Editor_GD( '/no/such.png' ) )->load()->get_error_code() );
