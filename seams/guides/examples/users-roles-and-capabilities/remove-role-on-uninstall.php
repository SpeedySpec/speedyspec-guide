<?php
// Remove what activation added when the plugin is deleted, in uninstall.php, moving people off the role first.
add_role( 'my_plugin_librarian', 'Librarian', array( 'read' => true, 'my_plugin_manage_books' => true ) );
get_role( 'administrator' )->add_cap( 'my_plugin_manage_books' );
$lena = wp_insert_user( array( 'user_login' => 'lena', 'user_pass' => wp_generate_password(), 'role' => 'my_plugin_librarian' ) );

function my_plugin_uninstall() {
	// A person whose role is removed is left with no capabilities at all, so give them a basic role first.
	foreach ( get_users( array( 'role' => 'my_plugin_librarian', 'fields' => 'ID' ) ) as $user_id ) {
		( new WP_User( $user_id ) )->set_role( 'subscriber' );
	}
	remove_role( 'my_plugin_librarian' );
	get_role( 'administrator' )->remove_cap( 'my_plugin_manage_books' );
}
my_plugin_uninstall();

$lena = get_userdata( $lena ); // Read the person again, now that the role is gone.
return array(
	'role exists'          => null !== get_role( 'my_plugin_librarian' ),
	'administrator can'    => get_role( 'administrator' )->has_cap( 'my_plugin_manage_books' ),
	'Lena can still read'  => $lena->has_cap( 'read' ),
	'Lena is now'          => $lena->roles,
);
