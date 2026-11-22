<?php
// Hooked to init: registers the Tag Cloud block (core/tag-cloud) from its block.json, with render_block_core_tag_cloud() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/tag-cloud' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
