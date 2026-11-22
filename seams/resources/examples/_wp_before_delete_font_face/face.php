<?php
// Deletes a font face's files from the fonts folder before the face is deleted.
function guide_temporary_font_dir( $dir ) {
	$dir['basedir'] = sys_get_temp_dir() . '/guide-fonts-' . getmypid();
	return $dir;
}
add_filter( 'font_dir', 'guide_temporary_font_dir' );
$dir = wp_get_font_dir()['basedir'];
wp_mkdir_p( $dir );
file_put_contents( "$dir/inter.woff2", 'x' );
$face = wp_insert_post( array( 'post_type' => 'wp_font_face', 'post_status' => 'publish' ) );
add_post_meta( $face, '_wp_font_face_file', 'inter.woff2' );
wp_delete_post( $face, true );
$exists = file_exists( "$dir/inter.woff2" );
rmdir( $dir );
return $exists;
