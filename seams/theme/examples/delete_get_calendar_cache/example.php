<?php
// Clears the cached calendars, when posts change.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( '/?m=202603' );
get_calendar( array( 'display' => false ) );
delete_get_calendar_cache();
return wp_cache_get( 'get_calendar', 'calendar' );
