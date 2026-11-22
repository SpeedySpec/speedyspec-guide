<?php
// Hooked to wp_enqueue_scripts: enqueues the block style variation styles gathered while rendering.
wp_enqueue_block_style_variation_styles();
return wp_style_is( 'block-style-variation-styles', 'enqueued' );
