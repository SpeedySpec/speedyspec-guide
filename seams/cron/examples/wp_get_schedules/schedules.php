<?php
// The recurrences: hourly, twicedaily, daily and weekly, after any cron_schedules adds (which can't replace the built-in ones).
add_filter( 'cron_schedules', fn( $s ) => $s + array( 'fortnightly' => array( 'interval' => 1209600, 'display' => 'Fortnightly' ), 'daily' => array( 'interval' => 1, 'display' => 'Replaced?' ) ) );
return wp_get_schedules();
