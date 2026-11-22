<?php
// The base editor's helpers: generate_filename() names a derived file by suffix (the size by default), folder and extension; get_suffix() is the size; set_quality() keeps 1 to 100, with wp_editor_set_quality and jpeg_quality as filters.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
$editor->load();
function guide_png_quality( $quality, $mime ) {
	return 'image/png' === $mime ? 70 : $quality;
}
add_filter( 'wp_editor_set_quality', 'guide_png_quality', 10, 2 );
$editor->set_quality();
$name = fn( $path ) => preg_replace( '/guide-\d+/', 'guide', basename( $path ) );
return array( $name( $editor->generate_filename() ), $name( $editor->generate_filename( 'edited', null, 'jpg' ) ), $editor->get_suffix(), $editor->get_quality(), $editor->set_quality( 101 )->get_error_code() );
