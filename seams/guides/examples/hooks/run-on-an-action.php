<?php
// An action runs every callback added to it, with the arguments it is fired with.
function guide_log_saved( $id ) {
	echo esc_html( "saved $id" );
}
add_action( 'guide_saved', 'guide_log_saved' );
do_action( 'guide_saved', 7 );
return null;
