<?php
// A visitor who isn't logged in is user 0, with no capabilities; handle them before using the current user.
function my_plugin_greeting_for_current_user() {
	if ( ! is_user_logged_in() ) {
		return __( 'Hello, visitor. Log in to see your books.', 'my-plugin' );
	}
	$user = wp_get_current_user();
	/* translators: %s: The person's display name. */
	return sprintf( __( 'Hello, %s.', 'my-plugin' ), $user->display_name );
}

$logged_in = my_plugin_greeting_for_current_user();
wp_set_current_user( 0 );
return array(
	'logged in'  => $logged_in,
	'logged out' => my_plugin_greeting_for_current_user(),
	'user ID'    => get_current_user_id(),
	'can read'   => current_user_can( 'read' ),
);
