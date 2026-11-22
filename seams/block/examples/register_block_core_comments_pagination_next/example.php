<?php
// Hooked to init: registers the Comments Next Page block (core/comments-pagination-next) from its block.json, with render_block_core_comments_pagination_next() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/comments-pagination-next' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
