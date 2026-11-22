<?php
// Hooked to init: registers the Author (deprecated) block (core/post-author) from its block.json, with render_block_core_post_author() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-author' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
