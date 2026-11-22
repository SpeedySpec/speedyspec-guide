<?php
// Hooked to init: registers the Search block (core/search) from its block.json, with render_block_core_search() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/search' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
