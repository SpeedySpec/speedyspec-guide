<?php
// Unregisters the fields named, or every field of the entity, and returns what it removed.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ), array( 'id' => 'pages' ) ) );
	echo count( wp_unregister_entity_fields( 'postType', 'book', 'isbn' ) ), ' ';
} );
do_action( 'init' );
return array_column( wp_get_registered_entity_fields( 'postType', 'book' ), 'id' );
