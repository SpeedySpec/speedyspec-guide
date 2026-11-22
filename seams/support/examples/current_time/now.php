<?php
// The current time in the site's timezone (or UTC when asked): mysql for a MySQL date, timestamp for a timestamp shifted by the offset, or any date format.
update_option( 'timezone_string', 'America/New_York' );
return array( current_time( 'timestamp' ) - current_time( 'timestamp', true ) === (int) ( wp_timezone()->getOffset( new DateTime() ) ), strlen( current_time( 'mysql' ) ), current_time( 'mysql', true ) === gmdate( 'Y-m-d H:i:s' ) );
