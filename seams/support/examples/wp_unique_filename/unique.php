<?php
// A sanitized file name not yet taken in a folder: -1, -2 and so on are added; also checked against image sizes and other extensions. wp_unique_filename filters it.
$dir = sys_get_temp_dir() . '/guide-unique-' . getmypid();
wp_mkdir_p( $dir );
touch( "$dir/photo.jpg" );
$names = array( wp_unique_filename( $dir, 'photo.jpg' ), wp_unique_filename( $dir, 'My File!.txt' ) );
unlink( "$dir/photo.jpg" ); rmdir( $dir );
return $names;
