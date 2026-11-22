<?php
// Hooked to init: registers the Navigation Overlay Close block (core/navigation-overlay-close) from its block.json, with render_block_core_navigation_overlay_close() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/navigation-overlay-close' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
