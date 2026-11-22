<?php
// Resizes within a box, keeping the proportions, or cropped to it; save() writes the result next to the original, named with its size, and returns its details.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
$editor->load();
$editor->resize( 100, 100 );
$fit = $editor->get_size();
$saved = $editor->save();
$cropped = new WP_Image_Editor_GD( $file );
$cropped->load();
$cropped->resize( 50, 50, true );
return array( $fit, preg_replace( '/guide-\d+/', 'guide', basename( $saved['path'] ) ), $saved['width'], $saved['height'], $saved['mime-type'], $cropped->get_size() );
