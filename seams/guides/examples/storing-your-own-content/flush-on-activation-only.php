<?php
// Flush rewrite rules once, on activation, after registering the type; flushing on every request is slow.
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

function my_plugin_activate() {
	my_plugin_register_book_type();
	flush_rewrite_rules();
}

function my_plugin_deactivate() {
	unregister_post_type( 'my_book' );
	flush_rewrite_rules();
}

// The example site uses plain links, which have no rewrite rules; switch to pretty links first.
global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/%postname%/' );

my_plugin_activate();
$after_activation = isset( get_option( 'rewrite_rules' )['books/?$'] );
my_plugin_deactivate();
return array( 'archive rule after activation' => $after_activation, 'after deactivation' => isset( get_option( 'rewrite_rules' )['books/?$'] ) );
