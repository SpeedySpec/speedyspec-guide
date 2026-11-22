<?php
// Creates or updates a user from the user screens' submitted fields: names, email, role, password and preferences; gives their ID or an error.
$user = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password() ) );
$_POST = array( 'email' => 'grace@example.org', 'first_name' => 'Grace', 'nickname' => 'Grace', 'display_name' => 'Grace' );
edit_user( $user );
return get_user_meta( $user, 'first_name', true );
