<?php
// When wp-editor is enqueued, every field script module becomes a dynamic module dependency of it.
add_action( 'wp_entity_fields_api_init', function () {
	wp_register_entity_fields( 'a', 'postType', 'book', array( array( 'id' => 'isbn' ) ), '@my-plugin/book-fields' );
} );
do_action( 'init' );
$scripts = new WP_Scripts();
$scripts->add( 'wp-editor', '/editor.js' );
$scripts->enqueue( 'wp-editor' );
_wp_add_entity_field_modules_to_editor_script( $scripts );
return $scripts->get_data( 'wp-editor', 'module_dependencies' );
