<?php
// Hooked to render_block_core/group: restores a Group block's inner container div for classic themes that rely on it.
return wp_restore_group_inner_container( '<div class="wp-block-group"><p>x</p></div>', array( 'blockName' => 'core/group', 'attrs' => array() ) );
