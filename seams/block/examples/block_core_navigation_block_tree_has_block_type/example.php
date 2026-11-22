<?php
// Whether blocks contain a block type, at any depth.
$blocks = new WP_Block_List( parse_blocks( '<!-- wp:group --><div class="wp-block-group"><!-- wp:search /--></div><!-- /wp:group -->' ) );
return array(
	block_core_navigation_block_tree_has_block_type( $blocks, 'core/search' ),
	block_core_navigation_block_tree_has_block_type( $blocks, 'core/search', array( 'core/group' ) ),
	block_core_navigation_block_tree_has_block_type( $blocks, 'core/image' ),
);
