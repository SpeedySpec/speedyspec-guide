<?php
// On wp-signup.php, adds an invalid_nonce error to a sign-up whose form nonce doesn't match its id; elsewhere, or with a good nonce, the result passes unchanged.
$_SERVER['PHP_SELF'] = '/wp-signup.php';
$_POST['signup_form_id'] = 'abc';
$_POST['_signup_form'] = wp_create_nonce( 'signup_form_abc' );
$good = signup_nonce_check( array( 'errors' => new WP_Error() ) );
$_POST['_signup_form'] = 'bad';
$bad = signup_nonce_check( array( 'errors' => new WP_Error() ) );
return array( $good['errors']->get_error_codes(), $bad['errors']->get_error_codes() );
