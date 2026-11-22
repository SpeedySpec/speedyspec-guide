<?php
// Roles and capabilities are stored in the database, so add them once, on activation.
function my_plugin_activate() {
	add_role(
		'my_plugin_librarian',
		__( 'Librarian', 'my-plugin' ),
		array(
			'read'                   => true,
			'my_plugin_manage_books' => true,
		)
	);
	get_role( 'administrator' )->add_cap( 'my_plugin_manage_books' );
}
register_activation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_activate' );

do_action( 'activate_my-plugin/my-plugin.php' );
$librarian = get_role( 'my_plugin_librarian' );
return array(
	'role exists'           => null !== $librarian,
	'librarian can'         => array_keys( array_filter( $librarian->capabilities ) ),
	'administrator can too' => get_role( 'administrator' )->has_cap( 'my_plugin_manage_books' ),
	'adding it again'       => add_role( 'my_plugin_librarian', 'Librarian' ),
);
