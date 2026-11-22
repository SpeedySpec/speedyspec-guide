<?php
// When an event is due and no other run holds the lock, sets the doing_cron transient and posts a non-blocking request to wp-cron.php; cron_request filters it. Nothing due, or a lock under WP_CRON_LOCK_TIMEOUT old, sends nothing.
function guide_fake_request( $pre, $args, $url ) {
	echo "request $url, blocking: ", var_export( $args['blocking'], true ), "\n";
	return array( 'response' => array( 'code' => 200 ) );
}
add_filter( 'pre_http_request', 'guide_fake_request', 10, 3 );
function guide_add_cron_header( $request ) {
	$request['args']['headers'] = array( 'X-Guide' => '1' );
	return $request;
}
add_filter( 'cron_request', 'guide_add_cron_header' );
$nothing_due = spawn_cron( 1500000000.5 );
wp_schedule_single_event( 1000000000, 'guide_due' );
$spawned = spawn_cron( 1500000000.5 );
return array( $nothing_due, $spawned, get_transient( 'doing_cron' ), spawn_cron( 1500000030.5 ) );
