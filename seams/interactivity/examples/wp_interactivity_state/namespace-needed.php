<?php
// Outside directive processing the namespace is needed.
function guide_report_doing_it_wrong( $function_name ) {
	echo "$function_name ";
}
add_action( 'doing_it_wrong_run', 'guide_report_doing_it_wrong' );
return wp_interactivity_state();
