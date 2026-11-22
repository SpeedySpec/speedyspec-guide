<?php
// Hooked to init: registers the File block (core/file) from its block.json, with render_block_core_file() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/file' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
