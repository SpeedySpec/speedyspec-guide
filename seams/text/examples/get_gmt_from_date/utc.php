<?php
// Converts a date in the site's time zone to UTC. (No database here: the time zone comes from a filter.)
function guide_new_york_timezone( $pre_option ) {
	return 'America/New_York';
}
add_filter( 'pre_option_timezone_string', 'guide_new_york_timezone' );
return get_gmt_from_date( '2026-01-15 09:00:00' );
