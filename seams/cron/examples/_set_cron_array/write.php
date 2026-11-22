<?php
// Saves events with version 2 into the cron option and returns whether it saved; saving what is already stored counts as a failure, a WP_Error with $wp_error.
$events = array( 2000000000 => array( 'guide_send' => array( md5( serialize( array() ) ) => array( 'schedule' => false, 'args' => array() ) ) ) );
$saved = _set_cron_array( $events );
$again = _set_cron_array( $events, true );
guide_crons();
return array( $saved, $again->get_error_code(), get_option( 'cron' )['version'] );
