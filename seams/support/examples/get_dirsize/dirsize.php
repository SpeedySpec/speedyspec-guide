<?php
// A folder's size in bytes, its subfolders included, cached in the dirsize_cache transient; false when it can't be read.
$dir = sys_get_temp_dir() . '/guide-' . getmypid();
wp_mkdir_p( "$dir/sub" );
file_put_contents( "$dir/a.txt", '12345' );
file_put_contents( "$dir/sub/b.txt", '123' );
$size = get_dirsize( $dir );
unlink( "$dir/a.txt" ); unlink( "$dir/sub/b.txt" ); rmdir( "$dir/sub" ); rmdir( $dir );
return $size;
