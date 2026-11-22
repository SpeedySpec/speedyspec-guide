<?php
// Hooked to wp_enqueue_scripts: enqueues the block custom CSS gathered while rendering.
wp_enqueue_block_custom_css();
return wp_style_is( 'wp-block-custom-css', 'registered' ) || wp_style_is( 'wp-block-custom-css', 'enqueued' );
