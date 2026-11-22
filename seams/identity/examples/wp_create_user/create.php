<?php
// Adds a user from a login, password and email, as wp_insert_user() does.
$id = wp_create_user( 'linus', 'secret', 'linus@example.org' );
return array( get_userdata( $id )->user_login, get_userdata( $id )->roles, wp_create_user( 'linus', 'x' )->get_error_code() );
