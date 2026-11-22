<?php
// Hooked to init: registers the Latest Comments block (core/latest-comments) from its block.json, with render_block_core_latest_comments() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/latest-comments' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
