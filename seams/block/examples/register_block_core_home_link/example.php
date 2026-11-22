<?php
// Hooked to init: registers the Home Link block (core/home-link) from its block.json, with render_block_core_home_link() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/home-link' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
