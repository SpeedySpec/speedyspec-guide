<?php
// Removes one event by its timestamp, hook and arguments, dropping empty hooks and timestamps; pre_unschedule_event can answer instead.
wp_schedule_single_event( 2000000000, 'guide_send', array( 1 ) );
wp_schedule_single_event( 2000000000, 'guide_send', array( 2 ) );
$removed = wp_unschedule_event( 2000000000, 'guide_send', array( 1 ) );
guide_crons();
add_filter( 'pre_unschedule_event', fn() => false );
return array( $removed, wp_unschedule_event( 2000000000, 'guide_send', array( 2 ), true )->get_error_code() );
