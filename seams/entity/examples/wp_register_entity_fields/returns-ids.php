<?php
// Returns the ids it registered; a field already registered is skipped and reported.
function guide_report_doing_it_wrong( $function_name ) { echo "$function_name "; }
add_action( 'doing_it_wrong_run', 'guide_report_doing_it_wrong' );
function guide_register_book_fields() {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ) );
	print_r( wp_register_entity_fields( 'b', 'postType', 'book', array( array( 'id' => 'isbn' ), array( 'id' => 'pages' ) ) ) );
}
add_action( 'wp_entity_fields_api_init', 'guide_register_book_fields' );
do_action( 'init' );
wp_get_registered_entity_fields( 'postType', 'book' );
