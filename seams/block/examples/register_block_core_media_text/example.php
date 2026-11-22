<?php
// Hooked to init: registers the Media & Text block (core/media-text) from its block.json, with render_block_core_media_text() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/media-text' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
