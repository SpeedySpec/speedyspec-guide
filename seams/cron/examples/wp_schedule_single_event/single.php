<?php
// Stores a one-off event under its timestamp, hook and an md5 of its arguments. The same hook and arguments within ten minutes of an existing event is a duplicate; with $wp_error, failures are WP_Errors.
$first = wp_schedule_single_event( 2000000000, 'guide_send', array( 'id' => 7 ) );
$duplicate = wp_schedule_single_event( 2000000300, 'guide_send', array( 'id' => 7 ), true );
$later = wp_schedule_single_event( 2000001000, 'guide_send', array( 'id' => 7 ) );
$invalid = wp_schedule_single_event( 0, 'guide_send', array(), true );
guide_crons();
return array( $first, $duplicate->get_error_code(), $later, $invalid->get_error_code() );
