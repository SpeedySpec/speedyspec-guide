<?php
// A tag name with spaces or characters such as & / < > [ ] = is refused and reported.
function guide_print_function_name( $function_name ) {
	echo "$function_name ";
}
add_action( 'doing_it_wrong_run', 'guide_print_function_name' );
function guide_x_shortcode() {
	return 'x';
}
add_shortcode( 'bad tag', 'guide_x_shortcode' );
return shortcode_exists( 'bad tag' );
