<?php
// The site's timezone as a string: timezone_string, else the gmt_offset as ±HH:MM.
$offset = wp_timezone_string();
update_option( 'gmt_offset', -5.5 );
$half = wp_timezone_string();
update_option( 'timezone_string', 'Asia/Tokyo' );
return array( $offset, $half, wp_timezone_string() );
