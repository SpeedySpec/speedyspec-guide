<?php
// Hooked to init: registers the Widget Group block (core/widget-group) from its block.json, with render_block_core_widget_group() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/widget-group' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
