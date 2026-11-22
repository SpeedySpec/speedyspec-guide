<?php
// The schedule name of a hook's next event with these arguments, or false; get_schedule filters it.
wp_schedule_event( 2000000000, 'twicedaily', 'guide_ping' );
wp_schedule_single_event( 2000000000, 'guide_once' );
$names = array( wp_get_schedule( 'guide_ping' ), wp_get_schedule( 'guide_once' ), wp_get_schedule( 'guide_none' ) );
function guide_default_schedule( $schedule, $hook ) {
	return $schedule ?: 'unscheduled';
}
add_filter( 'get_schedule', 'guide_default_schedule', 10, 2 );
return array( $names, wp_get_schedule( 'guide_none' ) );
