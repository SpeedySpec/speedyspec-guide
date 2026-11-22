<?php
// The recurrences: hourly, twicedaily, daily and weekly, after any cron_schedules adds (which can't replace the built-in ones).
function guide_add_schedules( $schedules ) {
	return $schedules + array( 'fortnightly' => array( 'interval' => 1209600, 'display' => 'Fortnightly' ), 'daily' => array( 'interval' => 1, 'display' => 'Replaced?' ) );
}
add_filter( 'cron_schedules', 'guide_add_schedules' );
return wp_get_schedules();
