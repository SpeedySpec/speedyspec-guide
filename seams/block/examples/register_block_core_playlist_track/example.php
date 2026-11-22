<?php
// Hooked to init: registers the Playlist track block (core/playlist-track) from its block.json, with render_block_core_playlist_track() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/playlist-track' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
