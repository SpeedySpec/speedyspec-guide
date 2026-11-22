<?php
// The 'all' hook's callbacks get every argument, whatever their accepted_args.
function guide_print_arguments( ...$args ) {
	echo implode( ',', $args );
}
$hook = new WP_Hook();
$hook->add_filter( 'all', 'guide_print_arguments', 10, 1 );
$args = array( 'guide_name', 'x', 'y' );
$hook->do_all_hook( $args );

return null;
