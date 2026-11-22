<?php
// Reports a function used the wrong way: fires doing_it_wrong_run, then raises a notice when debugging allows it.
function guide_print_doing_it_wrong( $function, $message, $version ) {
	echo "$function: $message ($version)\n";
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong', 10, 3 );
_doing_it_wrong( 'some_function', 'Call it after init.', '6.0.0' );
return 'reported';
