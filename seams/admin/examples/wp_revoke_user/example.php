<?php
// Removes all of a user's roles and capabilities.
$user = wp_insert_user( array( 'user_login' => 'grace', 'user_email' => 'grace@example.org', 'user_pass' => wp_generate_password(), 'role' => 'editor' ) );
wp_revoke_user( $user );
return get_userdata( $user )->roles;
