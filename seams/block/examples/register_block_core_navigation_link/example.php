<?php
// Hooked to init: registers the Navigation Link block (core/navigation-link) from its block.json, with render_block_core_navigation_link() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/navigation-link' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
