<?php
// Hooked to application_password_failed_authentication and _did_authenticate: notes the outcome (the user or the error) and the password's UUID for the REST checks.
global $wp_rest_application_password_status, $wp_rest_application_password_uuid;
rest_application_password_collect_status( get_user_by( 'id', 1 ), array( 'uuid' => 'abc-123' ) );
return array( $wp_rest_application_password_status->user_login, $wp_rest_application_password_uuid );
