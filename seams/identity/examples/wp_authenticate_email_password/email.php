<?php
// On authenticate: a user by email address and password; a login that isn't an email is passed on.
$user = wp_authenticate_email_password( null, 'admin@example.org', 'password' );
return array( $user->ID, wp_authenticate_email_password( null, 'admin@example.org', 'nope' )->get_error_code(), wp_authenticate_email_password( null, 'admin', 'password' ), wp_authenticate_email_password( null, 'ghost@example.org', 'x' )->get_error_code() );
