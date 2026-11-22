<?php
// Check wp_next_scheduled() before scheduling, or each activation adds another copy of the event.
function my_plugin_activate() {
	if ( ! wp_next_scheduled( 'my_plugin_daily_cleanup' ) ) {
		wp_schedule_event( time(), 'daily', 'my_plugin_daily_cleanup' );
	}
}

function my_plugin_activate_carelessly( $now ) { // Don't do this: nothing stops a second copy.
	wp_schedule_event( $now, 'daily', 'my_plugin_careless_cleanup' );
}

function guide_count_events( $hook ) { // Counts how many times the hook is scheduled.
	$count = 0;
	foreach ( _get_cron_array() as $hooks ) {
		$count += isset( $hooks[ $hook ] ) ? count( $hooks[ $hook ] ) : 0;
	}
	return $count;
}

foreach ( array( 1, 2, 3 ) as $activation ) { // Activated, deactivated without clearing, activated again, an hour apart.
	my_plugin_activate();
	my_plugin_activate_carelessly( time() + $activation * HOUR_IN_SECONDS );
}
return array( 'with the check' => guide_count_events( 'my_plugin_daily_cleanup' ), 'without' => guide_count_events( 'my_plugin_careless_cleanup' ) );
