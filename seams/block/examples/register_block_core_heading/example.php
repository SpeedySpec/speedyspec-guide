<?php
// Hooked to init: registers the Heading block (core/heading) from its block.json, with block_core_heading_render() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/heading' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
