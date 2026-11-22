<?php
// A recovery link is the login URL with action=enter_recovery_mode, a token and a fresh key; recovery_mode_begin_url filters it.
function guide_recovery_url( $url, $token, $key ) {
	return $url . '&guide=1';
}
add_filter( 'recovery_mode_begin_url', 'guide_recovery_url', 10, 3 );
$service = new WP_Recovery_Mode_Link_Service( new WP_Recovery_Mode_Cookie_Service(), new WP_Recovery_Mode_Key_Service() );
$url = $service->generate_url();
parse_str( parse_url( $url, PHP_URL_QUERY ), $query );
return array( strtok( $url, '?' ), $query['action'], array_keys( $query ), array_keys( get_option( 'recovery_keys' ) ) === array( $query['rm_token'] ) );
