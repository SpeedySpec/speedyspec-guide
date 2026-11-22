<?php
// Adds a field to an object type's responses (and schema), read by get_callback and written by update_callback; the posts controller calls them as it prepares and saves posts.
function guide_get_shout( $post ) {
	return strtoupper( $post['title']['raw'] ?? get_the_title( $post['id'] ) );
}
function guide_register_shout_field() {
	register_rest_field( 'post', 'guide_shout', array(
		'get_callback' => 'guide_get_shout',
		'schema'       => array( 'type' => 'string', 'context' => array( 'view', 'edit' ) ),
	) );
}
add_action( 'rest_api_init', 'guide_register_shout_field' );
$id = wp_insert_post( array( 'post_title' => 'quiet', 'post_status' => 'publish' ) );
return guide_rest( 'GET', "/wp/v2/posts/$id" )[1]['guide_shout'];
