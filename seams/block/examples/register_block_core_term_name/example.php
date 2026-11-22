<?php
// Hooked to init: registers the Term Name block (core/term-name) from its block.json, with render_block_core_term_name() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/term-name' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
