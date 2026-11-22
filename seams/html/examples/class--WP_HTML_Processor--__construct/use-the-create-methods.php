<?php
// Calling the constructor directly is reported: use create_fragment() or create_full_parser().
function guide_print_function_name( $function_name ) {
	echo "$function_name ";
}
add_action( 'doing_it_wrong_run', 'guide_print_function_name' );
new WP_HTML_Processor( '<p>' );
