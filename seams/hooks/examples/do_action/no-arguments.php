<?php
// With no arguments, callbacks receive one empty string.
function guide_print_arguments( ...$args ) {
	var_export( $args );
}
add_action( 'guide_bare', 'guide_print_arguments' );
do_action( 'guide_bare' );

return null;
