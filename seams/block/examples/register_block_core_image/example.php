<?php
// Hooked to init: registers the Image block (core/image) from its block.json, with render_block_core_image() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/image' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
