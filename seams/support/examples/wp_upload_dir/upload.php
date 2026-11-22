<?php
// The uploads folder's path, URL, subdir (year/month), basedir, baseurl and error, for a time or now; the folder is made when asked, and upload_dir filters it.
function guide_temporary_upload_path( $dir ) {
	$dir['path'] = sys_get_temp_dir() . '/guide-uploads' . $dir['subdir'];
	return $dir;
}
add_filter( 'upload_dir', 'guide_temporary_upload_path' );
$dir = wp_upload_dir( '2026/03', false );
return array( $dir['url'], $dir['subdir'], $dir['baseurl'] );
