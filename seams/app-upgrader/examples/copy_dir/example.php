<?php
// Copies a folder's contents into another folder through $wp_filesystem, skipping names listed; true or an error.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
wp_mkdir_p( "$dir/from/sub" );
file_put_contents( "$dir/from/a.txt", 'a' );
file_put_contents( "$dir/from/sub/b.txt", 'b' );
file_put_contents( "$dir/from/skip.txt", 's' );
WP_Filesystem();
wp_mkdir_p( "$dir/to" );
$result = copy_dir( "$dir/from", "$dir/to", array( 'skip.txt' ) );
$copied = array( file_exists( "$dir/to/sub/b.txt" ), file_exists( "$dir/to/skip.txt" ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $copied );
