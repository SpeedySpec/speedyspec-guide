<?php
// Records in a block's metadata the hooked blocks it already shows, so they aren't inserted twice.
register_block_type( 'guide/like', array( 'block_hooks' => array( 'core/post-content' => 'after' ), 'render_callback' => 'guide_render_like' ) );
function guide_render_like() {
	return '<button>Like</button>';
}
$anchor = array( 'blockName' => 'core/post-content', 'attrs' => array(), 'innerBlocks' => array() );
set_ignored_hooked_blocks_metadata( $anchor, 'after', get_hooked_blocks(), array() );
return $anchor['attrs']['metadata']['ignoredHookedBlocks'];
