<?php
// Hooked to init: registers the Accordion Item block (core/accordion-item) from its block.json, with block_core_accordion_item_render() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/accordion-item' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
