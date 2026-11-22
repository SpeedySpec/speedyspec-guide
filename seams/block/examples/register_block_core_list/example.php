<?php
// Hooked to init: registers the List block (core/list) from its block.json, with block_core_list_render() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/list' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
