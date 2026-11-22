<?php
// Hooked to init: registers the Terms List block (core/categories) from its block.json, with render_block_core_categories() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/categories' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
