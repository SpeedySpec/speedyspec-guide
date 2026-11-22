<?php
// Prints an admin notice, firing wp_admin_notice first.
add_action( 'wp_admin_notice', fn( $message ) => print( "notice: $message\n" ) );
return guide_render( fn() => wp_admin_notice( 'Careful.', array( 'type' => 'warning' ) ) );
