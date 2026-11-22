<?php
// The message shown after confirming a request from its link; for exports and erasures it says the admin was told.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
return array( _wp_privacy_account_request_confirmed_message( $request ), _wp_privacy_account_request_confirmed_message( 999 ) );
