<?php
// Hooked to init: registers the Cover block (core/cover) from its block.json, with render_block_core_cover() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/cover' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
