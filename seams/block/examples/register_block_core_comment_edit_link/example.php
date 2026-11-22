<?php
// Hooked to init: registers the Comment Edit Link block (core/comment-edit-link) from its block.json, with render_block_core_comment_edit_link() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/comment-edit-link' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
