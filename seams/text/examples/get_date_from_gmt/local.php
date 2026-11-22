<?php
// Converts a UTC date to the site's time zone.
add_filter( 'pre_option_timezone_string', fn() => 'America/New_York' );
return get_date_from_gmt( '2026-07-15 14:00:00' );
