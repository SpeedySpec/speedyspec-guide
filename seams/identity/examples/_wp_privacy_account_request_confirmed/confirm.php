<?php
// On user_request_action_confirmed: marks a pending request confirmed, recording when.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
_wp_privacy_account_request_confirmed( $request );
$req = wp_get_user_request( $request );
return array( $req->status, $req->confirmed_timestamp > 0, (bool) get_post_meta( $request, '_wp_user_request_confirmed_timestamp', true ) );
