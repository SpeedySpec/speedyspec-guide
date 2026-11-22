<?php
// Hooked to init: registers the Read More block (core/read-more) from its block.json, with render_block_core_read_more() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/read-more' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
