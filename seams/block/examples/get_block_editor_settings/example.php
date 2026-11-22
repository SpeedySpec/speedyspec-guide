<?php
// The block editor's settings for a context: defaults, theme supports, theme.json styles and settings, presets and categories; filtered by block_editor_settings_all.
$s = get_block_editor_settings( array(), new WP_Block_Editor_Context() );
return array( isset( $s['__experimentalFeatures'] ), isset( $s['styles'] ), isset( $s['blockCategories'] ) );
