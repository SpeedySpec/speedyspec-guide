<?php
// Hooked to rest_pre_insert_wp_template and wp_template_part: records in a saved template's anchor blocks the hooked blocks it already holds, so they aren't inserted twice.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/paragraph' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$changes = (object) array( 'post_type' => 'wp_template', 'post_name' => 'x', 'post_content' => '<!-- wp:paragraph --><p>x</p><!-- /wp:paragraph -->', 'tax_input' => array( 'wp_theme' => get_stylesheet() ) );
$updated = inject_ignored_hooked_blocks_metadata_attributes( $changes );
return $updated->post_content;
