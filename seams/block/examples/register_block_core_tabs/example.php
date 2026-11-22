<?php
// Hooked to init: registers the Tabs block (core/tabs) from its block.json, with block_core_tabs_render_block_callback() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/tabs' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
