<?php
// When a user changes their email on the profile screen, stores the new address as pending (_new_email) and emails it a confirmation link instead of changing it.
$_POST = array( 'user_id' => 1, 'email' => 'new@example.org' );
$GLOBALS['errors'] = new WP_Error();
send_confirmation_on_profile_email();
$pending = get_user_meta( 1, '_new_email', true );
return array( $pending['newemail'], strlen( $pending['hash'] ) > 0, get_userdata( 1 )->user_email );
