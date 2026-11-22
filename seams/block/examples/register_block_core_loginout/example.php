<?php
// Hooked to init: registers the Login/out block (core/loginout) from its block.json, with render_block_core_loginout() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/loginout' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
