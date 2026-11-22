<?php
// Hooked to init: registers the Query Total block (core/query-total) from its block.json, with render_block_core_query_total() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/query-total' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
