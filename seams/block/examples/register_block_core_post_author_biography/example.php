<?php
// Hooked to init: registers the Author Biography block (core/post-author-biography) from its block.json, with render_block_core_post_author_biography() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-author-biography' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
