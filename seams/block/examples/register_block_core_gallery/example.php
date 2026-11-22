<?php
// Hooked to init: registers the Gallery block (core/gallery) from its block.json, with block_core_gallery_render() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/gallery' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
