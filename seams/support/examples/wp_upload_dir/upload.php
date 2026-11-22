<?php
// The uploads folder's path, URL, subdir (year/month), basedir, baseurl and error, for a time or now; the folder is made when asked, and upload_dir filters it.
add_filter( 'upload_dir', function ( $dir ) { $dir['path'] = sys_get_temp_dir() . '/guide-uploads' . $dir['subdir']; return $dir; } );
$dir = wp_upload_dir( '2026/03', false );
return array( $dir['url'], $dir['subdir'], $dir['baseurl'] );
