<?php
// Whether a value is a WP_Error; fires is_wp_error_instance when it is.
add_action( 'is_wp_error_instance', fn( $e ) => print( 'error: ' . $e->get_error_code() . "\n" ) );
return array( is_wp_error( new WP_Error( 'nope' ) ), is_wp_error( false ) );
