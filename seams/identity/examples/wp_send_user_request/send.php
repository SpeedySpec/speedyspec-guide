<?php
// Emails the confirmation link of a privacy request, storing a new key; a missing request is a WP_Error.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
return array( wp_send_user_request( $request ), wp_send_user_request( 999 )->get_error_code() );
