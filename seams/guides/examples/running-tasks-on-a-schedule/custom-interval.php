<?php
// Add your own interval through cron_schedules, then schedule with its name.
function my_plugin_add_schedules( $schedules ) {
	$schedules['my_plugin_every_six_hours'] = array(
		'interval' => 6 * HOUR_IN_SECONDS,
		'display'  => __( 'Every six hours', 'my-plugin' ),
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'my_plugin_add_schedules' );

if ( ! wp_next_scheduled( 'my_plugin_sync_books' ) ) {
	wp_schedule_event( time(), 'my_plugin_every_six_hours', 'my_plugin_sync_books' );
}
$schedule = wp_get_schedules()['my_plugin_every_six_hours'];
return array(
	'name'       => $schedule['display'],
	'seconds'    => $schedule['interval'],
	'event uses' => wp_get_schedule( 'my_plugin_sync_books' ),
	'built in'   => array_keys( array_intersect_key( wp_get_schedules(), array_flip( array( 'hourly', 'twicedaily', 'daily', 'weekly' ) ) ) ),
);
