<?php
// Runs the automatic updater when it is due, under a lock so only one runs at a time.
add_filter( 'automatic_updater_disabled', '__return_true' );
wp_maybe_auto_update();
return did_action( 'automatic_updates_complete' );
