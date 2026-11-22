<?php
// The markup of the blocks hooked to a block at a position, unless ignored in its metadata; filtered by hooked_block_types and hooked_block.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$anchor = array( 'blockName' => 'core/post-content', 'attrs' => array(), 'innerBlocks' => array() );
return insert_hooked_blocks( $anchor, 'after', get_hooked_blocks(), array() );
