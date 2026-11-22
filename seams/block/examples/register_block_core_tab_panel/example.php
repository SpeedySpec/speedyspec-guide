<?php
// Hooked to init: registers the Tab Panel block (core/tab-panel) from its block.json, with block_core_tab_panel_render() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/tab-panel' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
