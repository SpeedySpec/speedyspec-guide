<?php
// Inserts hooked blocks into block markup, around and inside their anchors, for a template, part, pattern or post as context.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
return apply_block_hooks_to_content( '<!-- wp:post-content /-->', array(), 'insert_hooked_blocks' );
