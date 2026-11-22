<?php
// On authenticate: a user by login and password; an empty field, an unknown login or a wrong password is a WP_Error. A user already found is passed on.
$user = wp_authenticate_username_password( null, 'admin', 'password' );
return array( $user->ID, wp_authenticate_username_password( null, 'admin', 'nope' )->get_error_code(), wp_authenticate_username_password( null, 'ghost', 'x' )->get_error_code(), wp_authenticate_username_password( null, '', '' )->get_error_codes(), wp_authenticate_username_password( $user, 'x', 'y' )->ID );
