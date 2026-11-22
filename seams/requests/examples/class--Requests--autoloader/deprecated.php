<?php
// The Requests class of Requests 1.x, kept for back compatibility: including its file reports the deprecation, and its autoloader loads the old names.
add_action( 'deprecated_file_included', fn( $file, $replacement, $version ) => print( "deprecated_file_included $file $version\n" ), 10, 3 );
add_filter( 'deprecated_file_trigger_error', '__return_false' );
require ABSPATH . WPINC . '/class-requests.php';
return array( Requests::VERSION, method_exists( 'Requests', 'register_autoloader' ) );
