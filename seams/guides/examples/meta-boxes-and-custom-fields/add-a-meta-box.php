<?php
// Add a meta box to the classic post editor on add_meta_boxes; it prints a nonce and an escaped field.
require_once ABSPATH . 'wp-admin/includes/admin.php'; // Loaded on every admin screen; the example loads it itself.

function my_plugin_render_rating_box( $post ) {
	wp_nonce_field( 'my_plugin_save_rating', 'my_plugin_rating_nonce' );
	printf(
		'<label for="my-plugin-rating">%s</label> <input type="number" id="my-plugin-rating" name="my_plugin_rating" min="0" max="5" value="%s" />',
		esc_html__( 'Rating', 'my-plugin' ),
		esc_attr( (int) get_post_meta( $post->ID, 'my_plugin_rating', true ) )
	);
}

function my_plugin_add_rating_box() {
	add_meta_box( 'my-plugin-rating', __( 'Rating', 'my-plugin' ), 'my_plugin_render_rating_box', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'my_plugin_add_rating_box' );

$post_id = wp_insert_post( array( 'post_title' => 'Dune', 'post_status' => 'publish' ) );
update_post_meta( $post_id, 'my_plugin_rating', 4 );
set_current_screen( 'post' );
do_action( 'add_meta_boxes', 'post', get_post( $post_id ) ); // What the editor screen does as it loads.

$box = $GLOBALS['wp_meta_boxes']['post']['side']['default']['my-plugin-rating'];
ob_start();
call_user_func( $box['callback'], get_post( $post_id ) );
$html = ob_get_clean();
return array(
	'title'      => $box['title'],
	'has nonce'  => str_contains( $html, 'name="my_plugin_rating_nonce"' ),
	'field'      => preg_match( '/<input type="number"[^>]+>/', $html, $m ) ? $m[0] : null,
);
