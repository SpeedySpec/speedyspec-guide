<?php
// Unregisters actions by id, or all of an entity's actions.
add_action( 'wp_entity_actions_api_init', function () {
	wp_register_entity_actions( 'a', 'postType', 'book', array( array( 'id' => 'archive' ), array( 'id' => 'share' ) ) );
	wp_unregister_entity_actions( 'postType', 'book', array( 'archive' ) );
} );
do_action( 'init' );
return array_column( wp_get_registered_entity_actions( 'postType', 'book' ), 'id' );
