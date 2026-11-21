<?php
// Run every callback on an action, with its arguments.
add_action( 'guide_saved', function ( $id ) {
	echo "saved $id";
} );
do_action( 'guide_saved', 7 );

return null;
