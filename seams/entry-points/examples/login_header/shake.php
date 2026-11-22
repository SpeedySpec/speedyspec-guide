<?php
// An error whose code is in shake_error_codes (such as incorrect_password) makes the form shake: wp_shake_js is hooked to login_footer.
guide_load_functions( 'wp-login.php', 'login_header', 'login_footer', 'wp_shake_js', 'wp_login_viewport_meta' );
ob_start();
login_header( 'Log In', '', new WP_Error( 'incorrect_password', 'Wrong.' ) );
ob_end_clean();
$shakes = has_action( 'login_footer', 'wp_shake_js' );
function guide_no_shake_error_codes( $codes ) {
	return array();
}
add_filter( 'shake_error_codes', 'guide_no_shake_error_codes' );
remove_action( 'login_footer', 'wp_shake_js', 12 );
ob_start();
login_header( 'Log In', '', new WP_Error( 'incorrect_password', 'Wrong.' ) );
ob_end_clean();
return array( $shakes, has_action( 'login_footer', 'wp_shake_js' ) );
