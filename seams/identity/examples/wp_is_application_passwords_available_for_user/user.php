<?php
// Whether a user may have application passwords: available on the site, unless wp_is_application_passwords_available_for_user says no.
add_filter( 'wp_is_application_passwords_available', '__return_true' );
add_filter( 'wp_is_application_passwords_available_for_user', fn( $ok, $user ) => 1 !== $user->ID, 10, 2 );
$grace = guide_user();
return array( wp_is_application_passwords_available_for_user( 1 ), wp_is_application_passwords_available_for_user( $grace ), wp_is_application_passwords_available_for_user( 999 ) );
