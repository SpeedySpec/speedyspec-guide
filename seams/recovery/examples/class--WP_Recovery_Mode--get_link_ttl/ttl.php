<?php
// The email rate limit is a day (recovery_mode_email_rate_limit); a link lives as long (recovery_mode_email_link_ttl), but never less than the rate limit.
$mode = new WP_Recovery_Mode();
$defaults = array( guide_call( $mode, 'get_email_rate_limit' ), guide_call( $mode, 'get_link_ttl' ) );
add_filter( 'recovery_mode_email_link_ttl', fn() => HOUR_IN_SECONDS );
$short = guide_call( $mode, 'get_link_ttl' );
add_filter( 'recovery_mode_email_rate_limit', fn() => HOUR_IN_SECONDS / 2 );
return array( $defaults, $short, guide_call( $mode, 'get_link_ttl' ) );
