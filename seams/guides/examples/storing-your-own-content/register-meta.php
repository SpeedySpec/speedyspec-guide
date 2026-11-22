<?php
// Register the meta key with its type and sanitize callback; every save of it is then sanitized.
function my_plugin_register_book_type() {
	register_post_type(
		'my_book',
		array(
			'labels'       => array(
				'name'          => __( 'Books', 'my-plugin' ),
				'singular_name' => __( 'Book', 'my-plugin' ),
				'add_new_item'  => __( 'Add new book', 'my-plugin' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'books' ),
			'supports'     => array( 'title', 'editor', 'custom-fields' ),
		)
	);
}
function my_plugin_sanitize_isbn( $value ) {
	return preg_replace( '/[^0-9X]/', '', strtoupper( (string) $value ) );
}

function my_plugin_can_edit_isbn( $allowed, $meta_key, $post_id ) {
	return current_user_can( 'edit_post', $post_id );
}

function my_plugin_register_book_meta() {
	register_post_meta(
		'my_book',
		'my_book_isbn',
		array(
			'type'              => 'string',
			'description'       => __( 'The ISBN of the book.', 'my-plugin' ),
			'single'            => true,
			'sanitize_callback' => 'my_plugin_sanitize_isbn',
			'auth_callback'     => 'my_plugin_can_edit_isbn',
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'my_plugin_register_book_meta' );
my_plugin_register_book_type();
my_plugin_register_book_meta();

$book = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Dune', 'post_status' => 'publish' ) );
update_post_meta( $book, 'my_book_isbn', ' 978-0-441-01359-x ' );
return array(
	'registered' => registered_meta_key_exists( 'post', 'my_book_isbn', 'my_book' ),
	'stored'     => get_post_meta( $book, 'my_book_isbn', true ),
);
