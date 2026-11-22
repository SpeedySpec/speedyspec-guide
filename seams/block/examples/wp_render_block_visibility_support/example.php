<?php
// Hooked to render_block: renders nothing for a block hidden with blockVisibility false, and adds styles hiding it at the viewports it is hidden on.
return array( wp_render_block_visibility_support( '<p>x</p>', array( 'blockName' => 'core/paragraph', 'attrs' => array( 'metadata' => array( 'blockVisibility' => false ) ) ) ), wp_render_block_visibility_support( '<p>y</p>', array( 'blockName' => 'core/paragraph', 'attrs' => array() ) ) );
