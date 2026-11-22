<?php
// Sends a user the password reset email, by login or email; an empty or unknown one is a WP_Error.
$sent = retrieve_password( 'admin' );
return array( $sent, retrieve_password( 'nobody' )->get_error_code(), retrieve_password( '' )->get_error_code() );
