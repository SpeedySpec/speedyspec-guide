<?php
// Moves a folder through $wp_filesystem, renaming when it can and copying otherwise; refuses to overwrite unless asked.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
wp_mkdir_p( "$dir/from" );
file_put_contents( "$dir/from/a.txt", 'a' );
WP_Filesystem();
$result = move_dir( "$dir/from", "$dir/to" );
$moved = array( file_exists( "$dir/to/a.txt" ), file_exists( "$dir/from" ) );
wp_mkdir_p( "$dir/from" );
$again = move_dir( "$dir/from", "$dir/to" );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return array( $result, $moved, $again->get_error_code() );
