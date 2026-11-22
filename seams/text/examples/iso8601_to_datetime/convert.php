<?php
// Turns an ISO 8601 date into a MySQL datetime, in UTC or in the site's time zone. (No database here: the time zone comes from a filter.)
function guide_utc_timezone( $pre_option ) {
	return 'UTC';
}
add_filter( 'pre_option_timezone_string', 'guide_utc_timezone' );
return array( iso8601_to_datetime( '20260115T09:00:00+0100', 'gmt' ), iso8601_to_datetime( '20260115T09:00:00+0100', 'user' ) );
