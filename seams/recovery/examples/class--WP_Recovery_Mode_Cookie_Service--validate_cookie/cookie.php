<?php
// A recovery cookie is base64 of `recovery_mode|<created>|<random>|<signature>`, the signature an HMAC-SHA1 keyed with AUTH_KEY and AUTH_SALT. validate_cookie() checks its format, age (recovery_mode_cookie_length, a week) and signature; the session ID is the sha1 of its random part.
$service = new WP_Recovery_Mode_Cookie_Service();
$cookie = guide_call( $service, 'generate_cookie' );
list( $prefix, $created, $random ) = explode( '|', base64_decode( $cookie ) );
$forged = base64_encode( "recovery_mode|$created|$random|0000" );
$old = base64_encode( 'recovery_mode|1000000000|abc|x' );
$_COOKIE[ RECOVERY_MODE_COOKIE ] = $cookie;
return array( $prefix, $service->is_cookie_set(), $service->validate_cookie(), $service->get_session_id_from_cookie() === sha1( $random ), $service->validate_cookie( $forged )->get_error_code(), $service->validate_cookie( $old )->get_error_code(), $service->validate_cookie( base64_encode( 'a|b' ) )->get_error_code(), $service->validate_cookie( base64_encode( 'recovery_mode|soon|abc|x' ) )->get_error_code() );
