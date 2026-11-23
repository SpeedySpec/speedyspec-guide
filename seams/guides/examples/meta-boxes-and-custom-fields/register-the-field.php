<?php
// Register a custom field with register_post_meta(): its type, how it is sanitized, who may change it, and the REST API.
function my_plugin_can_edit_rating( $allowed, $meta_key, $post_id ) {
	return current_user_can( 'edit_post', $post_id );
}

function my_plugin_register_meta() {
	register_post_meta(
		'post',
		'my_plugin_rating',
		array(
			'type'              => 'integer',
			'description'       => __( 'The reader\'s rating, from 1 to 5.', 'my-plugin' ),
			'single'            => true,
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'auth_callback'     => 'my_plugin_can_edit_rating',
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'my_plugin_register_meta' );
my_plugin_register_meta(); // The example runs after init, so it registers the field itself.

$post_id = wp_insert_post( array( 'post_title' => 'Dune', 'post_status' => 'publish' ) );
$unset   = get_post_meta( $post_id, 'my_plugin_rating', true );
update_post_meta( $post_id, 'my_plugin_rating', '4 stars' ); // Sanitized on the way in.

$response = rest_do_request( new WP_REST_Request( 'GET', '/wp/v2/posts/' . $post_id ) );
return array(
	'before it is set' => $unset,
	'stored'           => get_post_meta( $post_id, 'my_plugin_rating', true ),
	'in the REST API'  => $response->get_data()['meta']['my_plugin_rating'],
	'registered'       => array_keys( get_registered_meta_keys( 'post', 'post' ) ),
);
