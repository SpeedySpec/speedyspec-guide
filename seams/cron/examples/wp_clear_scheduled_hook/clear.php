<?php
// Removes every event of a hook with the given arguments and returns how many; pre_clear_scheduled_hook can answer instead.
wp_schedule_single_event( 2000000000, 'guide_send', array( 1 ) );
wp_schedule_single_event( 2000009000, 'guide_send', array( 1 ) );
wp_schedule_single_event( 2000000000, 'guide_send', array( 2 ) );
$cleared = wp_clear_scheduled_hook( 'guide_send', array( 1 ) );
guide_crons();
add_filter( 'pre_clear_scheduled_hook', fn( $pre, $hook ) => 7, 10, 2 );
return array( $cleared, wp_clear_scheduled_hook( 'guide_send', array( 2 ) ) );
