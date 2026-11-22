<?php
// Without wp-editor enqueued, nothing is added.
add_action( 'wp_entity_actions_api_init', function () {
	wp_register_entity_actions( 'a', 'postType', 'book', array( array( 'id' => 'archive' ) ), '@my-plugin/book-actions' );
} );
do_action( 'init' );
$scripts = new WP_Scripts();
$scripts->add( 'wp-editor', '/editor.js' );
_wp_add_entity_action_modules_to_editor_script( $scripts );
return $scripts->get_data( 'wp-editor', 'module_dependencies' );
