<?php
// Converts a UTC date to the site's time zone.
function guide_new_york_timezone( $pre_option ) {
	return 'America/New_York';
}
add_filter( 'pre_option_timezone_string', 'guide_new_york_timezone' );
return get_date_from_gmt( '2026-07-15 14:00:00' );
