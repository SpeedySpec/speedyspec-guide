<?php
// The format a save writes: the file's own, the type asked for when supported, or image_editor_default_mime_type (JPEG); image_editor_output_format can map one type to another.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
$editor->load();
add_filter( 'image_editor_output_format', fn( $formats ) => $formats + array( 'image/png' => 'image/jpeg' ) );
$mapped = guide_call( $editor, 'get_output_format', '/tmp/a.png', null );
return array( $mapped, guide_call( $editor, 'get_output_format', '/tmp/a.gif', 'image/gif' ) );
