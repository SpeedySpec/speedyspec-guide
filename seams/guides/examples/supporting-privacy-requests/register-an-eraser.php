<?php
// An eraser removes a person's data, and says what it removed, what it must keep, and why.
function my_plugin_register_eraser( $erasers ) {
	$erasers['my-plugin-reading-list'] = array(
		'eraser_friendly_name' => __( 'My Plugin reading list', 'my-plugin' ),
		'callback'             => 'my_plugin_erase_reading_list',
	);
	return $erasers;
}
add_filter( 'wp_privacy_personal_data_erasers', 'my_plugin_register_eraser' );

function my_plugin_erase_reading_list( $email, $page = 1 ) {
	$user = get_user_by( 'email', $email );
	if ( ! $user ) {
		return array( 'items_removed' => false, 'items_retained' => false, 'messages' => array(), 'done' => true );
	}
	$removed  = delete_user_meta( $user->ID, 'my_plugin_reading_list' );
	$retained = (bool) get_user_meta( $user->ID, 'my_plugin_purchases', true );
	return array(
		'items_removed'  => $removed,
		'items_retained' => $retained,
		'messages'       => $retained ? array( __( 'Purchase records are kept for seven years for tax law.', 'my-plugin' ) ) : array(),
		'done'           => true,
	);
}

// The plugin keeps a reading list and purchase records per person, in user meta.
$reader = wp_insert_user( array( 'user_login' => 'ana', 'user_email' => 'ana@example.org', 'user_pass' => wp_generate_password() ) );
update_user_meta( $reader, 'my_plugin_reading_list', array( 'Dune', 'Emma', 'Ivanhoe' ) );
update_user_meta( $reader, 'my_plugin_purchases', array( 'order 1001' ) );

$eraser = apply_filters( 'wp_privacy_personal_data_erasers', array() )['my-plugin-reading-list'];
$result = call_user_func( $eraser['callback'], 'ana@example.org', 1 );
return array(
	'result'         => $result,
	'reading list'   => get_user_meta( $reader, 'my_plugin_reading_list', true ),
	'purchases kept' => get_user_meta( $reader, 'my_plugin_purchases', true ),
	'unknown email'  => call_user_func( $eraser['callback'], 'nobody@example.org', 1 )['items_removed'],
);
