<?php
// The user row by id, slug, email or login, cached; false when missing. to_array() gives the row as an array.
$row = WP_User::get_data_by( 'email', 'admin@example.org' );
return array( $row->user_login, WP_User::get_data_by( 'login', 'nobody' ), WP_User::get_data_by( 'id', 'x' ), array_keys( ( new WP_User( 1 ) )->to_array() ) );
