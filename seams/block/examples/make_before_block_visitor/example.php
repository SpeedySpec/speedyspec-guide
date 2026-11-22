<?php
// A callback for traverse_and_serialize_blocks() that inserts hooked blocks before each block and as its first child.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$visitor = make_before_block_visitor( get_hooked_blocks(), array(), 'insert_hooked_blocks' );
return is_callable( $visitor );
