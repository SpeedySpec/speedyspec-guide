<?php
// True while the action runs, false after.
add_action( 'guide_busy', function () {
	var_export( doing_action( 'guide_busy' ) );
} );
do_action( 'guide_busy' );

return doing_action( 'guide_busy' );
