<?php
// The 'all' hook's callbacks get every argument, whatever their accepted_args.
$hook = new WP_Hook();
$hook->add_filter( 'all', function ( ...$args ) {
	echo implode( ',', $args );
}, 10, 1 );
$args = array( 'guide_name', 'x', 'y' );
$hook->do_all_hook( $args );

return null;
