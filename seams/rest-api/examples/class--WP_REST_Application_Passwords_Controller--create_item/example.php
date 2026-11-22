<?php
// The application passwords controller: a user's application passwords at /wp/v2/users/<id>/application-passwords, created (the password shown once), listed, renamed and deleted, and introspect gives the one authenticating the request.
add_filter( 'wp_is_application_passwords_available', '__return_true' );
[ $status, $created ] = guide_rest( 'POST', '/wp/v2/users/me/application-passwords', array( 'name' => 'Phone' ) );
$list = guide_rest( 'GET', '/wp/v2/users/1/application-passwords' )[1];
return array( $status, $created['name'], strlen( $created['password'] ), isset( $list[0]['password'] ), guide_rest( 'GET', '/wp/v2/users/me/application-passwords/introspect' )[1]['code'] );
