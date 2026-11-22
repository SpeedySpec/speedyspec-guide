<?php
// Hooked to init: registers the Excerpt block (core/post-excerpt) from its block.json, with render_block_core_post_excerpt() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-excerpt' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
