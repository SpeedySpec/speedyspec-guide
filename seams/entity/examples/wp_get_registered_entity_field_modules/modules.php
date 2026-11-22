<?php
// The script modules that render an entity's fields, with the fields each one renders.
function guide_register_book_fields() {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ), '@my-plugin/book-fields' );
}
add_action( 'wp_entity_fields_api_init', 'guide_register_book_fields' );
do_action( 'init' );
return wp_get_registered_entity_field_modules( 'postType', 'book' );
