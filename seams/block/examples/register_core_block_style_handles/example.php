<?php
// Hooked to init: registers the style handles of every core block from their metadata, without reading each block.json.
register_core_block_style_handles();
return array( wp_style_is( 'wp-block-paragraph', 'registered' ), wp_style_is( 'wp-block-image-editor', 'registered' ) );
