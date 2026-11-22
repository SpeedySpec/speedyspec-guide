<?php
// Hooked to render_block: puts the elements class from a block's attributes onto its markup.
return wp_render_elements_class_name( '<div class="wp-block-group"></div>', array( 'blockName' => 'core/group', 'attrs' => array( 'className' => 'wp-elements-abc' ) ) );
