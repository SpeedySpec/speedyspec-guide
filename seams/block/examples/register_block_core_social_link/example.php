<?php
// Hooked to init: registers the Social Icon block (core/social-link) from its block.json, with render_block_core_social_link() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/social-link' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
