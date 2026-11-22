<?php
// The UTC offset in hours for the timezone_string option, or false when there is none; attached to pre_option_gmt_offset.
$none = wp_timezone_override_offset();
update_option( 'timezone_string', 'Asia/Kolkata' );
return array( $none, wp_timezone_override_offset() );
