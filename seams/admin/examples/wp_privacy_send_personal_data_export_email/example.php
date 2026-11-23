<?php
// Emails the person who asked their personal data export link, which expires after a few days; true or an error.
function guide_export_mail( $sent, $mail ) {
	// Returning true skips sending; the guide records the recipient instead.
	$GLOBALS['guide_export_mail'] = $mail['to'];
	return true;
}
add_filter( 'pre_wp_mail', 'guide_export_mail', 10, 2 );
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
wp_update_post( array( 'ID' => $request, 'post_status' => 'request-confirmed' ) );
update_post_meta( $request, '_export_file_name', 'export.zip' );
return array( wp_privacy_send_personal_data_export_email( $request ), $GLOBALS['guide_export_mail'] );
