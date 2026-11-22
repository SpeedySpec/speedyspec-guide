<?php
// Hooked to init: registers the Legacy Widget block (core/legacy-widget) from its block.json, with render_block_core_legacy_widget() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/legacy-widget' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
