<?php
// Hooked to init: registers the Pattern Placeholder block (core/pattern) from its block.json, with render_block_core_pattern() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/pattern' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
