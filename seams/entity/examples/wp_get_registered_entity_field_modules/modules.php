<?php
// The script modules that render an entity's fields, with the fields each one renders.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ), '@my-plugin/book-fields' );
} );
do_action( 'init' );
return wp_get_registered_entity_field_modules( 'postType', 'book' );
