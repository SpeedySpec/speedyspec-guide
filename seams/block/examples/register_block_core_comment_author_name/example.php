<?php
// Hooked to init: registers the Comment Author Name block (core/comment-author-name) from its block.json, with render_block_core_comment_author_name() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/comment-author-name' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
