<?php
// Hooked to init: registers the Featured Image block (core/post-featured-image) from its block.json, with render_block_core_post_featured_image() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-featured-image' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
