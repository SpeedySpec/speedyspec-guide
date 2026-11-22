<?php
// Removes every event of a hook, whatever its arguments, and returns how many; 0 when there were none. pre_unschedule_hook can answer instead.
wp_schedule_single_event( 2000000000, 'guide_send', array( 1 ) );
wp_schedule_single_event( 2000000000, 'guide_send', array( 2 ) );
wp_schedule_event( 2000005000, 'daily', 'guide_send' );
wp_schedule_single_event( 2000000000, 'guide_keep' );
$removed = wp_unschedule_hook( 'guide_send' );
guide_crons();
return array( $removed, wp_unschedule_hook( 'guide_send' ) );
