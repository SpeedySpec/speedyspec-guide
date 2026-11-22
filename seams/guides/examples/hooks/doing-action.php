<?php
// doing_action() is true while the action runs, and false after it.
function guide_report_busy() {
	var_export( doing_action( 'guide_busy' ) );
}
add_action( 'guide_busy', 'guide_report_busy' );
do_action( 'guide_busy' );
return doing_action( 'guide_busy' );
