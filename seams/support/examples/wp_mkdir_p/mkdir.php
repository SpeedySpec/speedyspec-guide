<?php
// Makes a folder and its parents, with the parent's permissions; true when it exists afterwards. Paths with stream wrappers it doesn't know, or with ../, are refused.
$base = sys_get_temp_dir() . '/guide-mkdir-' . getmypid();
$made = wp_mkdir_p( "$base/a/b" );
$exists = is_dir( "$base/a/b" );
rmdir( "$base/a/b" ); rmdir( "$base/a" ); rmdir( $base );
return array( $made, $exists, wp_mkdir_p( "$base/../x" ) );
