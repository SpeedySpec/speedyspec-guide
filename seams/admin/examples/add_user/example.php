<?php
// Creates a user from the Add New User form; gives their ID or an error.
$_POST = array( 'user_login' => 'grace', 'email' => 'grace@example.org', 'pass1' => 'a strong password', 'pass2' => 'a strong password', 'role' => 'author' );
$id = add_user();
return get_userdata( $id )->roles;
