<?php
// Hooked to init: registers the Comments Page Numbers block (core/comments-pagination-numbers) from its block.json, with render_block_core_comments_pagination_numbers() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/comments-pagination-numbers' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
