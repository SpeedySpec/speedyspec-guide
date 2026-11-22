<?php
// Hooked to init: registers the Tab List block (core/tab-list) from its block.json, with block_core_tab_list_render_callback() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/tab-list' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
