<?php
// Whether a user may have application passwords: available on the site, unless wp_is_application_passwords_available_for_user says no.
add_filter( 'wp_is_application_passwords_available', '__return_true' );
function guide_no_application_passwords_for_admin( $available, $user ) {
	return 1 !== $user->ID;
}
add_filter( 'wp_is_application_passwords_available_for_user', 'guide_no_application_passwords_for_admin', 10, 2 );
$grace = guide_user();
return array( wp_is_application_passwords_available_for_user( 1 ), wp_is_application_passwords_available_for_user( $grace ), wp_is_application_passwords_available_for_user( 999 ) );
