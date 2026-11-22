<?php
// A folder's size in bytes, adding up its files and subfolders, skipping excluded paths, and stopping past a time limit; sizes are cached in dirsize_cache, and pre_recurse_dirsize can answer.
$dir = sys_get_temp_dir() . '/guide-' . getmypid();
wp_mkdir_p( "$dir/sub" );
file_put_contents( "$dir/a.txt", '12345' );
file_put_contents( "$dir/sub/b.txt", '123' );
$without_sub = recurse_dirsize( $dir, "$dir/sub" );
delete_transient( 'dirsize_cache' );
$all = recurse_dirsize( $dir );
unlink( "$dir/a.txt" ); unlink( "$dir/sub/b.txt" ); rmdir( "$dir/sub" ); rmdir( $dir );
return array( $without_sub, $all );
