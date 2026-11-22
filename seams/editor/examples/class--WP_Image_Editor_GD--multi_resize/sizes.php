<?php
// Makes several sizes from the original at once, saving each and returning its file, size and type by name; a size with neither width nor height is skipped.
$file = sys_get_temp_dir() . '/guide-' . getmypid() . '.png';
$image = imagecreatetruecolor( 200, 100 );
imagefill( $image, 0, 0, imagecolorallocate( $image, 200, 30, 30 ) );
imagepng( $image, $file );
register_shutdown_function( fn() => array_map( 'unlink', glob( sys_get_temp_dir() . '/guide-' . getmypid() . '*' ) ) );
$editor = new WP_Image_Editor_GD( $file );
$editor->load();
$meta = $editor->multi_resize( array( 'thumb' => array( 'width' => 50, 'height' => 50, 'crop' => true ), 'medium' => array( 'width' => 120 ), 'bad' => array() ) );
foreach ( $meta as &$m ) { $m['file'] = preg_replace( '/guide-\d+/', 'guide', $m['file'] ); unset( $m['filesize'] ); }
return array( $meta, $editor->get_size() );
