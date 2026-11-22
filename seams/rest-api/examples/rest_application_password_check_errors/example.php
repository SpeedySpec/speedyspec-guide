<?php
// Hooked to rest_authentication_errors: turns a failed application password login into the request's error, or reports success.
global $wp_rest_application_password_status;
$wp_rest_application_password_status = new WP_Error( 'incorrect_password', 'Wrong.' );
$error = rest_application_password_check_errors( null );
$wp_rest_application_password_status = true;
return array( $error->get_error_code(), $error->get_error_data()['status'], rest_application_password_check_errors( null ) );
