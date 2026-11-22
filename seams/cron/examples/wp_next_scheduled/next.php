<?php
// The timestamp of a hook's next event with these arguments, or false; wp_next_scheduled filters it.
wp_schedule_single_event( 2000009000, 'guide_send' );
wp_schedule_single_event( 2000000000, 'guide_send' );
$next = wp_next_scheduled( 'guide_send' );
add_filter( 'wp_next_scheduled', fn( $timestamp, $event ) => $timestamp + 1, 10, 2 );
return array( $next, wp_next_scheduled( 'guide_send' ), wp_next_scheduled( 'guide_other' ) );
