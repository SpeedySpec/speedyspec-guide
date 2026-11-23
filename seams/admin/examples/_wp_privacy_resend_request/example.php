<?php
// Sends a privacy request's confirmation email again; true or an error.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
return _wp_privacy_resend_request( $request );
