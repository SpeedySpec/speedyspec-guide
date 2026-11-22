<?php
// Merges new settings into registered fields and records who updated them.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn', 'label' => 'ISBN' ) ) );
	wp_update_entity_fields( 'b', 'postType', 'book', array( array( 'id' => 'isbn', 'label' => 'Book number' ) ) );
} );
do_action( 'init' );
$field = wp_get_registered_entity_fields( 'postType', 'book' )[0];
return array( $field['label'], $field['origin'] );
