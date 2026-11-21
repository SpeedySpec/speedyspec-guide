<?php
// Fields are registered on wp_entity_fields_api_init, which fires the first time they are read after init.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'my-plugin', 'postType', 'book', array( array( 'id' => 'isbn', 'label' => 'ISBN' ) ) );
} );
do_action( 'init' );
return wp_get_registered_entity_fields( 'postType', 'book' );
