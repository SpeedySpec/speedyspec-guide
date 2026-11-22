<?php
// Hooked to init: registers the No Results block (core/query-no-results) from its block.json, with render_block_core_query_no_results() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/query-no-results' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
