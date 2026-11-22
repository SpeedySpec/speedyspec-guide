<?php
// Hooked to init: registers the Date block (core/post-date) from its block.json, with render_block_core_post_date() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-date' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
