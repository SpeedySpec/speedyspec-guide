<?php
// The script modules that run an entity's actions, with the actions each one runs.
function guide_register_book_actions() {
	wp_register_entity_actions( 'a', 'postType', 'book', array( array( 'id' => 'archive' ) ), '@my-plugin/book-actions' );
}
add_action( 'wp_entity_actions_api_init', 'guide_register_book_actions' );
do_action( 'init' );
return wp_get_registered_entity_action_modules( 'postType', 'book' );
