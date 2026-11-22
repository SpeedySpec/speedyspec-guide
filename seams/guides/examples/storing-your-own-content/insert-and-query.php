<?php
// Content of your post type is stored and queried like any post: insert it, then ask WP_Query for it by type.
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
my_plugin_register_book_type();

foreach ( array( 'Dune', 'Emma', 'Ivanhoe' ) as $title ) {
	wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => $title, 'post_status' => 'publish' ) );
}
wp_insert_post( array( 'post_type' => 'post', 'post_title' => 'Not a book', 'post_status' => 'publish' ) );

$books = new WP_Query(
	array(
		'post_type'      => 'my_book',
		'orderby'        => 'title',
		'order'          => 'ASC',
		'posts_per_page' => 10,
		'no_found_rows'  => true,
	)
);
return array(
	'WP_Query'  => wp_list_pluck( $books->posts, 'post_title' ),
	'get_posts' => wp_list_pluck( get_posts( array( 'post_type' => 'my_book', 'title' => 'Emma' ) ), 'post_title' ),
);
