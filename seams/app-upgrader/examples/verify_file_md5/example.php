<?php
// Checks a file against an MD5 given in hex or base64: true, false when unchecked, or an error when it doesn't match.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
file_put_contents( "$dir/a.txt", 'hello' );
$result = array( verify_file_md5( "$dir/a.txt", md5( 'hello' ) ), verify_file_md5( "$dir/a.txt", md5( 'other' ) )->get_error_code(), verify_file_md5( "$dir/a.txt", 'short' ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return $result;
