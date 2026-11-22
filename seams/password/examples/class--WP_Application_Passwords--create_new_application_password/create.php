<?php
// A user's application passwords, kept hashed in the _application_passwords user meta: create_new_application_password() makes a 24-character password with a UUID and gives it once in plain text; the site is then marked as using them. Names must be given.
$created = WP_Application_Passwords::create_new_application_password( 1, array( 'name' => 'Phone' ) );
list( $password, $item ) = $created;
return array( strlen( $password ), array_keys( $item ), str_starts_with( $item['password'], '$generic$' ), WP_Application_Passwords::is_in_use(), WP_Application_Passwords::create_new_application_password( 1, array() )->get_error_code() );
