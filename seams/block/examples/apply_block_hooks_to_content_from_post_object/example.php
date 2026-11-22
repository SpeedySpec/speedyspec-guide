<?php
// Inserts hooked blocks into a post's content, the post wrapped in a Post Content block so first-child and last-child hooks on it apply.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/paragraph' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$id = wp_insert_post( array( 'post_title' => 'Hooks', 'post_content' => '<!-- wp:paragraph --><p>x</p><!-- /wp:paragraph -->' ) );
return apply_block_hooks_to_content_from_post_object( get_post( $id )->post_content, get_post( $id ) );
