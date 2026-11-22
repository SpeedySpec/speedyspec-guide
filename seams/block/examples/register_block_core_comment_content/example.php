<?php
// Hooked to init: registers the Comment Content block (core/comment-content) from its block.json, with render_block_core_comment_content() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/comment-content' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
