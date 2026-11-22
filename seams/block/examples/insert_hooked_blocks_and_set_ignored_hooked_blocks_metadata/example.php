<?php
// Inserts the hooked blocks at a position and records them as ignored, in one pass.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$anchor = array( 'blockName' => 'core/post-content', 'attrs' => array(), 'innerBlocks' => array() );
$markup = insert_hooked_blocks_and_set_ignored_hooked_blocks_metadata( $anchor, 'after', get_hooked_blocks(), array() );
return array( $markup, $anchor['attrs']['metadata']['ignoredHookedBlocks'] );
