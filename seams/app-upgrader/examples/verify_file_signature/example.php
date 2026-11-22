<?php
// Checks a file against Ed25519 signatures with WordPress.org's trusted keys; true, or an error saying why not.
$dir = get_temp_dir() . 'guide-' . wp_generate_password( 6, false );
wp_mkdir_p( $dir );
file_put_contents( "$dir/a.txt", 'hello' );
$result = verify_file_signature( "$dir/a.txt", array( base64_encode( str_repeat( 'x', 64 ) ) ) );
WP_Filesystem();
$GLOBALS['wp_filesystem']->delete( $dir, true );
return $result->get_error_code();
