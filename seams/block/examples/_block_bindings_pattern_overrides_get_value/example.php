<?php
// The value a synced pattern's instance overrides for a block attribute, from the pattern block's content context, by the block's metadata name.
$block = new WP_Block( parse_blocks( '<!-- wp:paragraph {"metadata":{"name":"intro"}} --><p>Default</p><!-- /wp:paragraph -->' )[0], array( 'pattern/overrides' => array( 'intro' => array( 'content' => 'Overridden' ) ) ) );
$block->context = array( 'pattern/overrides' => array( 'intro' => array( 'content' => 'Overridden' ) ) );
return _block_bindings_pattern_overrides_get_value( array(), $block, 'content' );
