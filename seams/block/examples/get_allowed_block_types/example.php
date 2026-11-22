<?php
// The block types allowed in an editor context, true for all; filtered by allowed_block_types_all.
add_filter( 'allowed_block_types_all', 'guide_only_paragraphs' );
function guide_only_paragraphs() {
	return array( 'core/paragraph' );
}
return get_allowed_block_types( new WP_Block_Editor_Context() );
