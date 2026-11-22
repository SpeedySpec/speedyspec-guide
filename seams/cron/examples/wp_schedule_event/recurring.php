<?php
// Stores a recurring event with its schedule and interval; the schedule must be one wp_get_schedules() knows. Unlike single events, there is no duplicate check.
$daily = wp_schedule_event( 2000000000, 'daily', 'guide_cleanup' );
$again = wp_schedule_event( 2000000100, 'daily', 'guide_cleanup' );
$unknown = wp_schedule_event( 2000000000, 'fortnightly', 'guide_cleanup', array(), true );
guide_crons();
return array( $daily, $again, $unknown->get_error_code() );
