<?php
// Print a post's terms as links, escaping each name and URL: term names are typed by people.
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

function my_plugin_genre_links( $post_id ) {
	$terms = get_the_terms( $post_id, 'my_genre' );
	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}
	$links = array();
	foreach ( $terms as $term ) {
		$links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
	}
	return implode( ', ', $links );
}

$book = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Dune', 'post_status' => 'publish' ) );
wp_set_object_terms( $book, array( 'Sci-fi & <b>fantasy</b>' ), 'my_genre' );
return array( 'with a genre' => my_plugin_genre_links( $book ), 'without' => my_plugin_genre_links( wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Emma', 'post_status' => 'publish' ) ) ) );
