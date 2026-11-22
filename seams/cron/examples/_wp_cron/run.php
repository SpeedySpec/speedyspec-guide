<?php
// Spawns cron when an event is due, unless this is a wp-cron.php request or DISABLE_WP_CRON is set; returns the number of spawns, 0 when nothing ran, or false when spawning failed.
function guide_fake_request( $response ) {
	echo "request sent\n";
	return array( 'response' => array( 'code' => 200 ) );
}
add_filter( 'pre_http_request', 'guide_fake_request' );
$nothing = _wp_cron();
wp_schedule_single_event( 1000000000, 'guide_due' );
wp_schedule_single_event( 1000000100, 'guide_also_due' );
$ran = _wp_cron();
$_SERVER['REQUEST_URI'] = '/wp-cron.php?doing_wp_cron';
return array( $nothing, $ran, _wp_cron() );
