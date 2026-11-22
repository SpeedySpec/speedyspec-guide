<?php
// pre_schedule_event can answer instead of scheduling; schedule_event can change the event, or refuse it with false.
add_filter( 'schedule_event', function ( $event ) { $event->args = array( 'changed' ); return 'guide_refused' === $event->hook ? false : $event; } );
wp_schedule_single_event( 2000000000, 'guide_send' );
$refused = wp_schedule_single_event( 2000000000, 'guide_refused', array(), true );
add_filter( 'pre_schedule_event', fn( $pre, $event ) => 'guide_external' === $event->hook ? true : $pre, 10, 2 );
$external = wp_schedule_single_event( 2000000000, 'guide_external' );
guide_crons();
return array( $refused->get_error_code(), $external );
