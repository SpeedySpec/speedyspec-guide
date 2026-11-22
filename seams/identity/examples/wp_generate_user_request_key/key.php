<?php
// A new confirmation key for a request, stored hashed in the post's password with the time in its modified date.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
$key = wp_generate_user_request_key( $request );
return array( strlen( $key ), wp_validate_user_request_key( $request, $key ), wp_validate_user_request_key( $request, 'wrong' )->get_error_code() );
