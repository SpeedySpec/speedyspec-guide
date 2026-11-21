<?php
// With no arguments, callbacks receive one empty string.
add_action( 'guide_bare', function ( ...$args ) {
	var_export( $args );
} );
do_action( 'guide_bare' );

return null;
