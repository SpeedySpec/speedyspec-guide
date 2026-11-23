<?php
// Ajax handler for the Send Reset Link button on a user's screen: emails them a password reset link.
function guide_reset_mail( $sent, $mail ) {
	// Returning true skips sending; the guide records the recipient instead.
	$GLOBALS['guide_reset_mail'] = $mail['to'];
	return true;
}
add_filter( 'pre_wp_mail', 'guide_reset_mail', 10, 2 );
$user = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$sent = json_decode( guide_ajax( 'wp_ajax_send_password_reset', array( 'user_id' => $user, 'nonce' => wp_create_nonce( "reset-password-for-$user" ) ) ), true );
return array( $sent['success'], $GLOBALS['guide_reset_mail'] );
