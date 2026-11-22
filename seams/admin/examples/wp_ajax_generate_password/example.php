<?php
// Ajax handler that sends a new random password as JSON, for the password fields of user screens.
$sent = json_decode( guide_ajax( 'wp_ajax_generate_password' ), true );
return array( $sent['success'], strlen( $sent['data'] ) );
