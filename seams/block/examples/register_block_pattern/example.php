<?php
// Registers a block pattern by namespaced name, with its title, content and categories, keywords, block and post types.
register_block_pattern( 'guide/cta', array( 'title' => 'Call to action', 'content' => '<!-- wp:paragraph --><p>Buy</p><!-- /wp:paragraph -->', 'categories' => array( 'call-to-action' ) ) );
return WP_Block_Patterns_Registry::get_instance()->get_registered( 'guide/cta' )['categories'];
