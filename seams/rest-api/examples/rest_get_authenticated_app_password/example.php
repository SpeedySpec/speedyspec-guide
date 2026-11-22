<?php
// The UUID of the application password that authenticated the request, or null.
global $wp_rest_application_password_uuid;
$none = rest_get_authenticated_app_password();
$wp_rest_application_password_uuid = 'abc-123';
return array( $none, rest_get_authenticated_app_password() );
