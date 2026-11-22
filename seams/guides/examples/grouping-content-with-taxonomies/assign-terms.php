<?php
// Add terms, with a parent for a hierarchy, then set a post's terms by their IDs.
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
my_plugin_register_types();

$fiction = wp_insert_term( __( 'Fiction', 'my-plugin' ), 'my_genre' );
$scifi   = wp_insert_term( __( 'Science fiction', 'my-plugin' ), 'my_genre', array( 'parent' => $fiction['term_id'] ) );
$book    = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Dune', 'post_status' => 'publish' ) );

// IDs must be integers: a numeric string is read as a term's name, and would create a new term.
wp_set_object_terms( $book, array( (int) $scifi['term_id'] ), 'my_genre' );
$first = wp_get_object_terms( $book, 'my_genre', array( 'fields' => 'names' ) );

// The fourth argument appends instead of replacing.
wp_set_object_terms( $book, array( (int) $fiction['term_id'] ), 'my_genre', true );
return array(
	'after setting'   => $first,
	'after appending' => wp_get_object_terms( $book, 'my_genre', array( 'fields' => 'names', 'orderby' => 'name' ) ),
	'parent of sci-fi' => get_term( $scifi['term_id'] )->parent === $fiction['term_id'],
);
