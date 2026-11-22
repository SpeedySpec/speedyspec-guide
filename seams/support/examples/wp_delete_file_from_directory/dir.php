<?php
// Deletes a file only when it is inside a folder; false otherwise.
$dir = sys_get_temp_dir() . '/guide-' . getmypid();
wp_mkdir_p( "$dir/sub" );
file_put_contents( "$dir/a.txt", '12345' );
file_put_contents( "$dir/sub/b.txt", '123' );
$outside = wp_delete_file_from_directory( "$dir/a.txt", "$dir/sub" );
$inside = wp_delete_file_from_directory( "$dir/sub/b.txt", "$dir/sub" );
file_put_contents( "$dir/sub/b.txt", '' );
unlink( "$dir/a.txt" ); unlink( "$dir/sub/b.txt" ); rmdir( "$dir/sub" ); rmdir( $dir );
return array( $outside, $inside );
