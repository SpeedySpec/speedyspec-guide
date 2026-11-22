<?php
// Hooked to render_block: puts the unique variation class added to a block's attributes onto its markup.
$block = array( 'blockName' => 'core/group', 'attrs' => array( 'className' => 'is-style-x is-style-x--abc' ) );
return wp_render_block_style_variation_class_name( '<div class="wp-block-group is-style-x"></div>', $block );
