<?php
// An Ajax handler on wp_ajax_{action}: check the nonce and the capability, change only what was asked, answer in JSON.
function my_plugin_dismiss_notice() {
	check_ajax_referer( 'my_plugin_dismiss', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => __( 'You may not do that.', 'my-plugin' ) ), 403 );
	}
	update_user_meta( get_current_user_id(), 'my_plugin_dismissed_key_notice', 1 );
	wp_send_json_success();
}
add_action( 'wp_ajax_my_plugin_dismiss', 'my_plugin_dismiss_notice' ); // For logged-in people only: no wp_ajax_nopriv_.

// What admin-ajax.php does: fire wp_ajax_{action}. The example catches the end of the request instead of exiting.
class Guide_Request_Ended extends Exception {}
function guide_end_request( $message ) {
	throw new Guide_Request_Ended( is_string( $message ) ? $message : '' );
}
function guide_end_request_handler() {
	return 'guide_end_request';
}
add_filter( 'wp_doing_ajax', '__return_true' );
add_filter( 'wp_die_ajax_handler', 'guide_end_request_handler' );
function guide_ajax( $nonce ) {
	$_REQUEST['nonce'] = $nonce;
	ob_start();
	try {
		do_action( 'wp_ajax_my_plugin_dismiss' );
	} catch ( Guide_Request_Ended $e ) {
		$body = ob_get_clean() . $e->getMessage();
		return array( 'body' => $body, 'dismissed' => (bool) get_user_meta( get_current_user_id(), 'my_plugin_dismissed_key_notice', true ) );
	}
	return array( 'body' => ob_get_clean() );
}

$forged = guide_ajax( 'not-a-nonce' );
$editor = wp_insert_user( array( 'user_login' => 'eve', 'user_pass' => wp_generate_password(), 'role' => 'editor' ) );
wp_set_current_user( $editor );
$not_allowed = guide_ajax( wp_create_nonce( 'my_plugin_dismiss' ) );
wp_set_current_user( 1 );
return array( 'forged nonce' => $forged, 'an editor' => $not_allowed, 'the administrator' => guide_ajax( wp_create_nonce( 'my_plugin_dismiss' ) ) );
