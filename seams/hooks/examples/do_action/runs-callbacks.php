<?php
// Run every callback on an action, with its arguments.
function guide_log_saved( $id ) {
	echo "saved $id";
}
add_action( 'guide_saved', 'guide_log_saved' );
do_action( 'guide_saved', 7 );

return null;
