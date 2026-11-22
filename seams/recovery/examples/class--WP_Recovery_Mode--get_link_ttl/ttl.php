<?php
// The email rate limit is a day (recovery_mode_email_rate_limit); a link lives as long (recovery_mode_email_link_ttl), but never less than the rate limit.
$mode = new WP_Recovery_Mode();
$defaults = array( guide_call( $mode, 'get_email_rate_limit' ), guide_call( $mode, 'get_link_ttl' ) );
function guide_link_ttl( $ttl ) {
	return HOUR_IN_SECONDS;
}
add_filter( 'recovery_mode_email_link_ttl', 'guide_link_ttl' );
$short = guide_call( $mode, 'get_link_ttl' );
function guide_email_rate_limit( $rate_limit ) {
	return HOUR_IN_SECONDS / 2;
}
add_filter( 'recovery_mode_email_rate_limit', 'guide_email_rate_limit' );
return array( $defaults, $short, guide_call( $mode, 'get_link_ttl' ) );
