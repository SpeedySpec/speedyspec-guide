<?php
// Hooked to render_block: adds the block-level presets class to a block that has settings.
return str_contains( _wp_add_block_level_presets_class( '<div class="wp-block-group"></div>', array( 'blockName' => 'core/group', 'attrs' => array( 'settings' => array( 'color' => array( 'palette' => array( array( 'slug' => 'x', 'color' => '#000', 'name' => 'X' ) ) ) ) ) ) ), 'wp-settings-' );
