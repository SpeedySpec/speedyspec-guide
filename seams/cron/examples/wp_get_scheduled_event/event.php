<?php
// The next event of a hook with these arguments, or the one at a timestamp, as an object; false when there is none. pre_get_scheduled_event can answer instead.
wp_schedule_event( 2000000000, 'hourly', 'guide_ping', array( 'a' ) );
add_filter( 'pre_get_scheduled_event', fn( $pre, $hook ) => 'guide_faked' === $hook ? (object) array( 'hook' => $hook ) : $pre, 10, 2 );
return array( wp_get_scheduled_event( 'guide_ping', array( 'a' ) ), wp_get_scheduled_event( 'guide_ping', array( 'a' ), 2000000001 ), wp_get_scheduled_event( 'guide_ping' ), wp_get_scheduled_event( 'guide_faked' ) );
