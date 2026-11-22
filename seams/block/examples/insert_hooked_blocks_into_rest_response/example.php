<?php
// Hooked to rest_prepare_{$post_type}: inserts hooked blocks into a post's raw content in the REST response, for the editor.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$id = wp_insert_post( array( 'post_title' => 'P', 'post_type' => 'wp_block', 'post_status' => 'publish', 'post_content' => '<!-- wp:post-content /-->' ) );
$response = new WP_REST_Response( array( 'content' => array( 'raw' => '<!-- wp:post-content /-->' ) ) );
return insert_hooked_blocks_into_rest_response( $response, get_post( $id ) )->get_data()['content']['raw'];
