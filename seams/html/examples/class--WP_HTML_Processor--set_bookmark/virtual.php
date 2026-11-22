<?php
// A bookmark can't be set on a token the HTML only implies.
function guide_print_function_name( $function_name ) {
	echo "$function_name ";
}
add_action( 'doing_it_wrong_run', 'guide_print_function_name' );
$p = WP_HTML_Processor::create_fragment( '<p>one<p>two' );
$p->next_token();
$p->next_token();
$p->next_token();
return array( $p->is_tag_closer(), $p->set_bookmark( 'here' ) );
