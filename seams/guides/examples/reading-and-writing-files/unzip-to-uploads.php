<?php
// unzip_file() extracts an archive through the Filesystem API; wp_tempnam() gives a safe temporary file to work in.
// The example keeps its uploads in a temporary folder, not the site's real one.
function guide_temporary_uploads( $dirs ) {
	$base              = sys_get_temp_dir() . '/guide-uploads';
	$dirs['basedir']   = $base;
	$dirs['path']      = $base . $dirs['subdir'];
	return $dirs;
}
add_filter( 'upload_dir', 'guide_temporary_uploads' );
require_once ABSPATH . 'wp-admin/includes/file.php';
WP_Filesystem();

$zip_file = wp_tempnam( 'my-plugin-import.zip' );
$zip      = new ZipArchive();
$zip->open( $zip_file, ZipArchive::OVERWRITE );
$zip->addFromString( 'books/dune.txt', 'Dune' );
$zip->addFromString( 'books/emma.txt', 'Emma' );
$zip->close();

$target = trailingslashit( wp_upload_dir( null, false )['basedir'] ) . 'my-plugin/import';
$result = unzip_file( $zip_file, $target );
wp_delete_file( $zip_file );

global $wp_filesystem;
$files = array_keys( $wp_filesystem->dirlist( $target . '/books' ) );
sort( $files );
$wp_filesystem->delete( $target, true ); // true: the folder and everything in it.
return array( 'unzipped' => true === $result, 'files' => $files, 'cleaned up' => ! $wp_filesystem->exists( $target ) );
