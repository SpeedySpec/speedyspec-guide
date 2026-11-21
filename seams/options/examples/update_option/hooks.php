<?php
// The actions update_option() fires, in order.
foreach ( array( 'update_option', 'update_option_blogname', 'updated_option' ) as $hook ) {
	add_action( $hook, function () use ( $hook ) {
		echo "$hook ";
	} );
}
update_option( 'blogname', 'Renamed' );
