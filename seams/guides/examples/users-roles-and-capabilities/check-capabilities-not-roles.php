<?php
// Check the capability an action needs, not a role's name: sites change which roles may do what.
function my_plugin_can_manage_books( $user_id ) {
	return user_can( $user_id, 'my_plugin_manage_books' );
}

function my_plugin_is_administrator( $user_id ) { // Don't do this: it ignores what the site's owner has granted.
	return in_array( 'administrator', get_userdata( $user_id )->roles, true );
}

$editor = wp_insert_user( array( 'user_login' => 'eve', 'user_pass' => wp_generate_password(), 'role' => 'editor' ) );

// The site's owner lets editors manage books, from a role editor or a line of their own code.
get_role( 'editor' )->add_cap( 'my_plugin_manage_books' );

return array(
	'capability check' => my_plugin_can_manage_books( $editor ),
	'role check'       => my_plugin_is_administrator( $editor ),
);
