<?php
// Adds a field to an object type's responses (and schema), read by get_callback and written by update_callback; the posts controller calls them as it prepares and saves posts.
add_action( 'rest_api_init', function () {
	register_rest_field( 'post', 'guide_shout', array(
		'get_callback' => fn( $post ) => strtoupper( $post['title']['raw'] ?? get_the_title( $post['id'] ) ),
		'schema'       => array( 'type' => 'string', 'context' => array( 'view', 'edit' ) ),
	) );
} );
$id = wp_insert_post( array( 'post_title' => 'quiet', 'post_status' => 'publish' ) );
return guide_rest( 'GET', "/wp/v2/posts/$id" )[1]['guide_shout'];
