<?php
// Hooked to init: registers the Post Template block (core/post-template) from its block.json, with render_block_core_post_template() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/post-template' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
