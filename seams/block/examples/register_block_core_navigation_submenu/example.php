<?php
// Hooked to init: registers the Submenu block (core/navigation-submenu) from its block.json, with render_block_core_navigation_submenu() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/navigation-submenu' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
