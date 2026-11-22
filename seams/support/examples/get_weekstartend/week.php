<?php
// The start and end timestamps of the week holding a MySQL date, the week starting on start_of_week (or the given day).
$week = get_weekstartend( '2026-03-04 12:00:00' );
return array( gmdate( 'D Y-m-d H:i', $week['start'] ), gmdate( 'D Y-m-d H:i:s', $week['end'] ) );
