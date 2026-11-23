<?php
// Through the Filesystem API: WP_Filesystem() picks how to reach the disk, then $wp_filesystem reads and writes.
// The example keeps its uploads in a temporary folder, not the site's real one.
function guide_temporary_uploads( $dirs ) {
	$base              = sys_get_temp_dir() . '/guide-uploads';
	$dirs['basedir']   = $base;
	$dirs['path']      = $base . $dirs['subdir'];
	return $dirs;
}
add_filter( 'upload_dir', 'guide_temporary_uploads' );
require_once ABSPATH . 'wp-admin/includes/file.php'; // Loaded on admin screens; the example loads it itself.

function my_plugin_write_export( $name, $contents ) {
	global $wp_filesystem;
	if ( ! WP_Filesystem() ) {
		return new WP_Error( 'my_plugin_no_filesystem', __( 'The files could not be written.', 'my-plugin' ) );
	}
	$folder = trailingslashit( wp_upload_dir( null, false )['basedir'] ) . 'my-plugin';
	wp_mkdir_p( $folder );
	$file = $folder . '/' . sanitize_file_name( $name );
	return $wp_filesystem->put_contents( $file, $contents, FS_CHMOD_FILE ) ? $file : new WP_Error( 'my_plugin_write_failed', __( 'The file could not be saved.', 'my-plugin' ) );
}

$file = my_plugin_write_export( '../../Reading list.csv', "book,read_on\nDune,2026-01-10\n" );
global $wp_filesystem;
$result = array(
	'method'    => get_filesystem_method(),
	'saved as'  => basename( $file ),
	'contents'  => $wp_filesystem->get_contents( $file ),
	'exists'    => $wp_filesystem->exists( $file ),
);
$wp_filesystem->delete( $file );
$result['after delete'] = $wp_filesystem->exists( $file );
return $result;
