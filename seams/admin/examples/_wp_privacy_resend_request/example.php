<?php
// Sends a privacy request's confirmation email again; true or an error.
function guide_resend_mail( $sent, $mail ) {
	// Returning true skips sending; the guide records the recipient instead.
	$GLOBALS['guide_resend_mail'] = $mail['to'];
	return true;
}
add_filter( 'pre_wp_mail', 'guide_resend_mail', 10, 2 );
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
return array( _wp_privacy_resend_request( $request ), $GLOBALS['guide_resend_mail'] );
