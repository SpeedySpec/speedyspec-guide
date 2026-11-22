<?php
// Adds a user (or updates one with an ID): login, password (hashed), email, URL, names, nicename and display name, role, and meta like admin_color and show_admin_bar_front. Logins over 60 characters, taken logins or emails, and illegal logins are refused. user_register fires; returns the ID.
function guide_print_user_register( $user_id ) {
	echo "user_register\n";
}
add_action( 'user_register', 'guide_print_user_register' );
$id = wp_insert_user( array( 'user_login' => 'ada', 'user_pass' => 'secret', 'user_email' => 'ada@example.org', 'first_name' => 'Ada', 'last_name' => 'Lovelace', 'role' => 'author' ) );
$user = get_userdata( $id );
return array( $user->display_name, $user->user_nicename, $user->roles, wp_check_password( 'secret', $user->user_pass, $id ), get_user_meta( $id, 'admin_color', true ), wp_insert_user( array( 'user_login' => 'ada', 'user_pass' => 'x' ) )->get_error_code(), wp_insert_user( array( 'user_login' => 'bob', 'user_email' => 'ada@example.org' ) )->get_error_code(), wp_insert_user( array( 'user_login' => '' ) )->get_error_code() );
