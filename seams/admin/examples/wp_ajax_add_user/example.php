<?php
// Ajax handler for the quick Add User form: creates the user and sends back their list table row as XML.
$sent = guide_ajax( fn() => wp_ajax_add_user( 'create-user' ), array( 'user_login' => 'grace', 'email' => 'grace@example.org', 'pass1' => 'a strong password', 'pass2' => 'a strong password', 'role' => 'author' ), 'create-user' );
return array( str_contains( $sent, '<wp_ajax>' ), get_user_by( 'login', 'grace' )->roles );
