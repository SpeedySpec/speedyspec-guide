<?php
// An event is a name: when it is due, WP-Cron fires the action of that name, and your named function does the work.
function my_plugin_delete_old_drafts() {
	echo esc_html__( 'Cleaning up old drafts.', 'my-plugin' ) . ' ';
}
add_action( 'my_plugin_daily_cleanup', 'my_plugin_delete_old_drafts' );

wp_schedule_event( time() - MINUTE_IN_SECONDS, 'daily', 'my_plugin_daily_cleanup' ); // Already due.

// What wp-cron.php does for each due event: schedule a recurring one's next run, remove this run, fire the action.
foreach ( wp_get_ready_cron_jobs() as $timestamp => $hooks ) {
	foreach ( $hooks as $hook => $events ) {
		foreach ( $events as $event ) {
			if ( $event['schedule'] ) {
				wp_reschedule_event( $timestamp, $event['schedule'], $hook, $event['args'] );
			}
			wp_unschedule_event( $timestamp, $hook, $event['args'] );
			do_action_ref_array( $hook, $event['args'] );
		}
	}
}
return array(
	'ran'              => did_action( 'my_plugin_daily_cleanup' ),
	'next run is later' => wp_next_scheduled( 'my_plugin_daily_cleanup' ) > time(),
	'still due'        => count( wp_get_ready_cron_jobs() ),
);
