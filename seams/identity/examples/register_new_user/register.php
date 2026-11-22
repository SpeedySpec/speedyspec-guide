<?php
// Registers a visitor: checks the login and email (registration_errors), creates the user with a generated password, and sends the new-user emails; returns the ID or a WP_Error.
$id = register_new_user( 'visitor', 'visitor@example.org' );
return array( get_userdata( $id )->roles, register_new_user( 'visitor', 'other@example.org' )->get_error_code(), register_new_user( 'x y!', 'bad' )->get_error_codes() );
