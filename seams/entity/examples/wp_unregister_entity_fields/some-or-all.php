<?php
// Unregisters the fields named, or every field of the entity, and returns what it removed.
function guide_register_then_unregister_book_fields() {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ), array( 'id' => 'pages' ) ) );
	echo count( wp_unregister_entity_fields( 'postType', 'book', 'isbn' ) ), ' ';
}
add_action( 'wp_entity_fields_api_init', 'guide_register_then_unregister_book_fields' );
do_action( 'init' );
return array_column( wp_get_registered_entity_fields( 'postType', 'book' ), 'id' );
