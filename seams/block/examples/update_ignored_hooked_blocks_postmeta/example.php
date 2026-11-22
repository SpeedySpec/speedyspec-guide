<?php
// Hooked to rest_pre_insert_{$post_type}: stores in an existing post's _wp_ignored_hooked_blocks meta the hooked blocks its new content already holds as first or last children of the post itself.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/block' => 'last_child' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$id = wp_insert_post( array( 'post_title' => 'P', 'post_type' => 'wp_block', 'post_status' => 'publish', 'post_content' => '' ) );
$changes = (object) array( 'ID' => $id, 'post_type' => 'wp_block', 'post_content' => '<!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --><!-- wp:guide/like /-->' );
$updated = update_ignored_hooked_blocks_postmeta( $changes );
return $updated->meta_input['_wp_ignored_hooked_blocks'] ?? 'none';
