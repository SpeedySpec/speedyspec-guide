<?php
// The events of the cron option without its version; an option that isn't an array gives an empty array, and one without a version is upgraded first.
wp_schedule_single_event( 2000000000, 'guide_send' );
$events = _get_cron_array();
update_option( 'cron', 'broken' );
return array( $events, _get_cron_array() );
