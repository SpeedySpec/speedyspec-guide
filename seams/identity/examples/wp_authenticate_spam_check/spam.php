<?php
// On authenticate on a network: refuses a user marked as spam; on a single site the user is passed on.
$user = get_userdata( 1 );
return wp_authenticate_spam_check( $user )->ID;
