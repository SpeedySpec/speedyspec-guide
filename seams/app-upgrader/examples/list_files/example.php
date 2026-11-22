<?php
// The paths of the files in a folder, recursing to a depth and skipping hidden files and listed names, or false.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
file_put_contents( "$dir/a.txt", 'a' );
wp_mkdir_p( "$dir/sub" );
file_put_contents( "$dir/sub/b.txt", 'b' );
file_put_contents( "$dir/.hidden", 'h' );
$files = array_map( fn( $f ) => str_replace( "$dir/", '', $f ), list_files( $dir ) );
sort( $files );
$top = list_files( $dir, 1 );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $files, count( $top ) );
