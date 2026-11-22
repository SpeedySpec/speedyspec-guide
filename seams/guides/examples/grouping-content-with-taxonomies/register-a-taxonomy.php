<?php
// Register the taxonomy on init with the post types it groups; hierarchical makes it like categories.
function my_plugin_register_types() {
	register_post_type( 'my_book', array( 'label' => __( 'Books', 'my-plugin' ), 'public' => true, 'show_in_rest' => true ) );
	register_taxonomy(
		'my_genre',
		'my_book',
		array(
			'labels'            => array(
				'name'          => __( 'Genres', 'my-plugin' ),
				'singular_name' => __( 'Genre', 'my-plugin' ),
			),
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		)
	);
}
add_action( 'init', 'my_plugin_register_types' );

// The site has already fired init when the example runs, so it calls the function itself.
my_plugin_register_types();
$genre = get_taxonomy( 'my_genre' );
return array(
	'exists'            => taxonomy_exists( 'my_genre' ),
	'hierarchical'      => $genre->hierarchical,
	'for'               => $genre->object_type,
	'singular'          => $genre->labels->singular_name,
	'assign capability' => $genre->cap->assign_terms,
);
