<?php
// Actions are registered on wp_entity_actions_api_init, which fires the first time they are read after init.
function guide_register_book_actions() {
	wp_register_entity_actions( 'my-plugin', 'postType', 'book', array( array( 'id' => 'archive', 'label' => 'Archive' ) ), '@my-plugin/book-actions' );
}
add_action( 'wp_entity_actions_api_init', 'guide_register_book_actions' );
do_action( 'init' );
return array_column( wp_get_registered_entity_actions( 'postType', 'book' ), 'label', 'id' );
