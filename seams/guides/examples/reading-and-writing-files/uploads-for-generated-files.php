<?php
// Files a plugin makes belong in the uploads folder, in a folder of its own, never in the plugin's folder.
// The example keeps its uploads in a temporary folder, not the site's real one.
function guide_temporary_uploads( $dirs ) {
	$base              = sys_get_temp_dir() . '/guide-uploads';
	$dirs['basedir']   = $base;
	$dirs['path']      = $base . $dirs['subdir'];
	return $dirs;
}
add_filter( 'upload_dir', 'guide_temporary_uploads' );

function my_plugin_export_folder() {
	$uploads = wp_upload_dir( null, false );
	$folder  = trailingslashit( $uploads['basedir'] ) . 'my-plugin/exports';
	wp_mkdir_p( $folder );
	return array( 'path' => $folder, 'url' => trailingslashit( $uploads['baseurl'] ) . 'my-plugin/exports' );
}

$folder = my_plugin_export_folder();
return array(
	'folder exists' => is_dir( $folder['path'] ),
	'path'          => str_replace( sys_get_temp_dir(), '<tmp>', $folder['path'] ),
	'url'           => $folder['url'],
);
