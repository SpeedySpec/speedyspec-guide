<?php
// Ajax handler for logged-out visitors, such as on the password reset screen: sends a new random password as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_nopriv_generate_password' ), true );
return array( $sent['success'], strlen( $sent['data'] ) );
