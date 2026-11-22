<?php
// Ajax handler for the Send Reset Link button on a user's screen: emails them a password reset link.
$user = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$sent = json_decode( guide_ajax( 'wp_ajax_send_password_reset', array( 'user_id' => $user, 'nonce' => wp_create_nonce( "reset-password-for-$user" ) ) ), true );
return $sent['success'];
