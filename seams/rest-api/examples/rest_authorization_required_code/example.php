<?php
// The status for a forbidden request: 403 for a logged-in user, 401 otherwise.
$in = rest_authorization_required_code();
wp_set_current_user( 0 );
return array( $in, rest_authorization_required_code() );
