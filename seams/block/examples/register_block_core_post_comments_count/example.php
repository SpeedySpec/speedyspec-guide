<?php
// Hooked to init: registers the Comments Count block (core/post-comments-count) from its block.json, with render_block_core_post_comments_count() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-comments-count' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
