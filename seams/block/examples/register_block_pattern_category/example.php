<?php
// Registers a block pattern category with its label.
register_block_pattern_category( 'guide', array( 'label' => 'Guide' ) );
return WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'guide' );
