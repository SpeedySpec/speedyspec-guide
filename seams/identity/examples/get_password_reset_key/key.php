<?php
// A password reset key for a user, stored hashed with its time in user_activation_key; a user who may not reset gets a WP_Error.
$key = get_password_reset_key( get_userdata( 1 ) );
return array( strlen( $key ), str_contains( get_userdata( 1 )->user_activation_key, ':' ), check_password_reset_key( $key, 'admin' )->ID );
