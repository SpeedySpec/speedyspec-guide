<?php
// Every field script module, by kind and name.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ), '@my-plugin/book-fields' );
} );
do_action( 'init' );
return wp_get_all_registered_entity_field_modules();
