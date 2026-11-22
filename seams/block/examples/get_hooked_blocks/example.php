<?php
// The block hooks registered by block types, by anchor block and position.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
return get_hooked_blocks()['core/post-content'];
