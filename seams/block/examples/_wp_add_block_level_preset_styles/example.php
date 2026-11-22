<?php
// Hooked to pre_render_block: enqueues the CSS variables of a block's own presets, scoped to its presets class.
_wp_add_block_level_preset_styles( null, array( 'blockName' => 'core/group', 'attrs' => array( 'settings' => array( 'color' => array( 'palette' => array( array( 'slug' => 'x', 'color' => '#000', 'name' => 'X' ) ) ) ) ) ) );
return 'enqueued';
