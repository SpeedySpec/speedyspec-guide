<?php
// Checks a request to authorize an application password: its success and reject URLs must be HTTPS and allowed; gives true or an error.
return array( wp_is_authorize_application_password_request_valid( array( 'success_url' => 'https://app.example.org/done' ), wp_get_current_user() ), wp_is_authorize_application_password_request_valid( array( 'success_url' => 'http://app.example.org/done' ), wp_get_current_user() )->get_error_code() );
