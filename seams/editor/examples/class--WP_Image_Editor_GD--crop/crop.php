<?php
// Crops a region, optionally scaled to a new size; rotate() turns the image (counter-clockwise), flip() mirrors it.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
$editor->load();
$editor->crop( 10, 10, 100, 50 );
$cropped = $editor->get_size();
$editor->rotate( 90 );
$rotated = $editor->get_size();
return array( $cropped, $rotated, $editor->flip( true, false ), $editor->crop( 0, 0, 0, 10 )->get_error_code() );
