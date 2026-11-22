<?php
// Register the post type on init, every request: WordPress doesn't remember it between requests.
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
add_action( 'init', 'my_plugin_register_book_type' );

// The site has already fired init when the example runs, so it calls the function itself.
my_plugin_register_book_type();
$type = get_post_type_object( 'my_book' );
return array(
	'exists'          => post_type_exists( 'my_book' ),
	'name'            => $type->labels->name,
	'add new item'    => $type->labels->add_new_item,
	'in the REST API' => $type->show_in_rest,
	'edit capability' => $type->cap->edit_posts,
);
