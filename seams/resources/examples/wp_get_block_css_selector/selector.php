<?php
// A block type's CSS selector for a target (root, a feature such as typography, or a subfeature path), from its selectors or the older supports; a fallback to the root when asked.
$block = WP_Block_Type_Registry::get_instance()->get_registered( 'core/image' );
return array( wp_get_block_css_selector( $block ), wp_get_block_css_selector( $block, 'border' ), wp_get_block_css_selector( $block, 'nope', true ) );
