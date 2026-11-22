<?php
// Hooked to init: registers the Button block (core/button) from its block.json, with render_block_core_button() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/button' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
