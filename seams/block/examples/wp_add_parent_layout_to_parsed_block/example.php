<?php
// Hooked to render_block_data: passes a parent's layout to its inner blocks, as parentLayout, for child layout styles.
$parent = new WP_Block( parse_blocks( '<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} --><div class="wp-block-group"><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></div><!-- /wp:group -->' )[0] );
$child = wp_add_parent_layout_to_parsed_block( array( 'blockName' => 'core/paragraph', 'attrs' => array() ), array(), $parent );
return $child['parentLayout'];
