<?php
// Hooked to init: registers the Term Template block (core/term-template) from its block.json, with render_block_core_term_template() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/term-template' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
