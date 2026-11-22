<?php
// Schedules the next run of a recurring event: one interval from now when the timestamp is now or later, or the next whole interval after a past timestamp. An unknown schedule falls back to the event's stored interval.
wp_reschedule_event( time() + 10, 'hourly', 'guide_ping' );
$next = wp_next_scheduled( 'guide_ping' ) - time();
$past = time() - 5400;
wp_reschedule_event( $past, 'hourly', 'guide_late' );
$late = wp_next_scheduled( 'guide_late' ) - time();
add_filter( 'pre_reschedule_event', fn( $pre, $event ) => 'guide_skip' === $event->hook ? false : $pre, 10, 2 );
return array( abs( $next - 3600 ) <= 1, abs( $late - 1800 ) <= 1, wp_reschedule_event( time(), 'nope', 'guide_none', array(), true )->get_error_code(), wp_reschedule_event( time(), 'hourly', 'guide_skip', array(), true )->get_error_code() );
