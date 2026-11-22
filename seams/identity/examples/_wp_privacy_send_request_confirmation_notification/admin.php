<?php
// After a request is confirmed, emails the site admin once (recording that it was sent).
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
_wp_privacy_account_request_confirmed( $request );
_wp_privacy_send_request_confirmation_notification( $request );
_wp_privacy_send_request_confirmation_notification( $request );
return (bool) get_post_meta( $request, '_wp_admin_notified', true );
