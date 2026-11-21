<?php
// Returns the ids it registered; a field already registered is skipped and reported.
add_action( 'doing_it_wrong_run', function ( $function_name ) { echo "$function_name "; } );
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ) );
	print_r( wp_register_entity_fields( 'b', 'postType', 'book', array( array( 'id' => 'isbn' ), array( 'id' => 'pages' ) ) ) );
} );
do_action( 'init' );
wp_get_registered_entity_fields( 'postType', 'book' );
