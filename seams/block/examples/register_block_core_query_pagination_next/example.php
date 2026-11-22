<?php
// Hooked to init: registers the Next Page block (core/query-pagination-next) from its block.json, with render_block_core_query_pagination_next() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/query-pagination-next' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
