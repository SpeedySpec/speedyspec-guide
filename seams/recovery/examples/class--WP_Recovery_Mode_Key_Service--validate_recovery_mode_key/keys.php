<?php
// A key is stored hashed in the recovery_keys option under a token, with its creation time; generate_recovery_mode_key fires with the token and the plain key. Validating removes the record, so a key works once; a wrong key, an expired key or an unknown token fails.
function guide_report_recovery_key( $token, $key ) {
	print( "generate_recovery_mode_key $token, key of " . strlen( $key ) . "\n" );
}
add_action( 'generate_recovery_mode_key', 'guide_report_recovery_key', 10, 2 );
$service = new WP_Recovery_Mode_Key_Service();
$token = $service->generate_recovery_mode_token();
$key = $service->generate_and_store_recovery_mode_key( 'guide_token' );
$stored = get_option( 'recovery_keys' );
$valid = $service->validate_recovery_mode_key( 'guide_token', $key, DAY_IN_SECONDS );
$again = $service->validate_recovery_mode_key( 'guide_token', $key, DAY_IN_SECONDS );
$service->generate_and_store_recovery_mode_key( 'wrong' );
$wrong = $service->validate_recovery_mode_key( 'wrong', 'not the key', DAY_IN_SECONDS );
$late = $service->generate_and_store_recovery_mode_key( 'late' );
$expired = $service->validate_recovery_mode_key( 'late', $late, -1 );
return array( strlen( $token ), array_keys( $stored['guide_token'] ), $valid, $again->get_error_code(), $wrong->get_error_code(), $expired->get_error_code(), get_option( 'recovery_keys' ) );
