<?php
// The actions delete_option() fires, in order.
foreach ( array( 'delete_option', 'delete_option_blogdescription', 'deleted_option' ) as $hook ) {
	add_action( $hook, function () use ( $hook ) {
		echo "$hook ";
	} );
}
delete_option( 'blogdescription' );
