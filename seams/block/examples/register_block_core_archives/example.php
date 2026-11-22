<?php
// Hooked to init: registers the Archives block (core/archives) from its block.json, with render_block_core_archives() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/archives' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
