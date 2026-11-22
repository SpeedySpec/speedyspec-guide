<?php
// A callback for traverse_and_serialize_blocks() that inserts hooked blocks after each block and as its last child.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$blocks = parse_blocks( '<!-- wp:post-content /-->' );
return traverse_and_serialize_blocks( $blocks, null, make_after_block_visitor( get_hooked_blocks(), array(), 'insert_hooked_blocks' ) );
