<?php
// Hooked to init: registers the Comments Link block (core/post-comments-link) from its block.json, with render_block_core_post_comments_link() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-comments-link' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
