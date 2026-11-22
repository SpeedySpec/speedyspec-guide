<?php
// When print_embed_styles is still hooked to embed_head, unhooks it and enqueues the embed template's styles inline instead.
$untouched = wp_enqueue_embed_styles();
add_action( 'embed_head', 'print_embed_styles' );
wp_enqueue_embed_styles();
return array( $untouched, has_action( 'embed_head', 'print_embed_styles' ), wp_style_is( 'wp-embed-template', 'enqueued' ) );
