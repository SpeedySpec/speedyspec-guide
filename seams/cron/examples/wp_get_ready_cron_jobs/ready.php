<?php
// The events due now, by timestamp; pre_get_ready_cron_jobs can answer instead.
wp_schedule_single_event( 1000000000, 'guide_due' );
wp_schedule_single_event( 2000000000, 'guide_later' );
$ready = wp_get_ready_cron_jobs();
function guide_no_ready_jobs( $pre ) {
	return array();
}
add_filter( 'pre_get_ready_cron_jobs', 'guide_no_ready_jobs' );
return array( array_keys( $ready ), array_keys( current( $ready ) ), wp_get_ready_cron_jobs() );
