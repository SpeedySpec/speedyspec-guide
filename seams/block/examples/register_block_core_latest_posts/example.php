<?php
// Hooked to init: registers the Latest Posts block (core/latest-posts) from its block.json, with render_block_core_latest_posts() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/latest-posts' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
