<?php
// Query posts by term with tax_query; a parent term includes its children's posts unless you say otherwise.
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

$fiction = wp_insert_term( 'Fiction', 'my_genre' );
$scifi   = wp_insert_term( 'Science fiction', 'my_genre', array( 'parent' => $fiction['term_id'] ) );
$emma    = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Emma', 'post_status' => 'publish' ) );
$dune    = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Dune', 'post_status' => 'publish' ) );
wp_set_object_terms( $emma, array( (int) $fiction['term_id'] ), 'my_genre' );
wp_set_object_terms( $dune, array( (int) $scifi['term_id'] ), 'my_genre' );

function my_plugin_books_in_genre( $slug, $include_children ) {
	$query = new WP_Query(
		array(
			'post_type'     => 'my_book',
			'orderby'       => 'title',
			'order'         => 'ASC',
			'no_found_rows' => true,
			'tax_query'     => array(
				array(
					'taxonomy'         => 'my_genre',
					'field'            => 'slug',
					'terms'            => $slug,
					'include_children' => $include_children,
				),
			),
		)
	);
	return wp_list_pluck( $query->posts, 'post_title' );
}
return array(
	'fiction, with children'    => my_plugin_books_in_genre( 'fiction', true ),
	'fiction, without children' => my_plugin_books_in_genre( 'fiction', false ),
	'science fiction'           => my_plugin_books_in_genre( 'science-fiction', true ),
);
