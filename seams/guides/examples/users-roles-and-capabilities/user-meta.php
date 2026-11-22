<?php
// A per-person setting is user meta: register it with a type and sanitizer, and check who may change it.
function my_plugin_can_edit_reading_goal( $allowed, $meta_key, $user_id ) {
	return current_user_can( 'edit_user', $user_id );
}

function my_plugin_register_user_meta() {
	register_meta(
		'user',
		'my_plugin_reading_goal',
		array(
			'type'              => 'integer',
			'description'       => __( 'How many books the person wants to read this year.', 'my-plugin' ),
			'single'            => true,
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'auth_callback'     => 'my_plugin_can_edit_reading_goal',
		)
	);
}
add_action( 'init', 'my_plugin_register_user_meta' );
my_plugin_register_user_meta();

$sam = wp_insert_user( array( 'user_login' => 'sam', 'user_pass' => wp_generate_password(), 'role' => 'subscriber' ) );
update_user_meta( 1, 'my_plugin_reading_goal', '24 books' );
return array(
	'admin goal'         => get_user_meta( 1, 'my_plugin_reading_goal', true ),
	'Sam goal, not set'  => get_user_meta( $sam, 'my_plugin_reading_goal', true ),
	'admin may edit Sam' => current_user_can( 'edit_user_meta', $sam, 'my_plugin_reading_goal' ),
);
