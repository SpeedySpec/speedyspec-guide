<?php
// An event is a name: when it is due, WP-Cron fires the action of that name, and your named function does the work.
function my_plugin_delete_old_drafts() {
	echo 'Cleaning up old drafts. ';
}
add_action( 'my_plugin_daily_cleanup', 'my_plugin_delete_old_drafts' );

wp_schedule_event( time() - MINUTE_IN_SECONDS, 'daily', 'my_plugin_daily_cleanup' ); // Already due.

// What wp-cron.php does on a page load after the event's time: fire each due event's action.
foreach ( wp_get_ready_cron_jobs() as $timestamp => $hooks ) {
	foreach ( $hooks as $hook => $events ) {
		foreach ( $events as $event ) {
			do_action_ref_array( $hook, $event['args'] );
		}
	}
}
return did_action( 'my_plugin_daily_cleanup' );
