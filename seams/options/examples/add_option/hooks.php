<?php
// The actions add_option() fires, in order.
foreach ( array( 'add_option', 'add_option_guide_color', 'added_option' ) as $hook ) {
	add_action( $hook, function () use ( $hook ) {
		echo "$hook ";
	} );
}
add_option( 'guide_color', 'blue' );
