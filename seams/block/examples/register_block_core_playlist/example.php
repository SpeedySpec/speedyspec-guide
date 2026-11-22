<?php
// Hooked to init: registers the Playlist block (core/playlist) from its block.json, with render_block_core_playlist() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/playlist' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
