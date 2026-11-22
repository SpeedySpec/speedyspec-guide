<?php
// Registers a callback for URLs matching a pattern, tried before oEmbed; wp_embed_unregister_handler() removes it.
wp_embed_register_handler( 'guide', '#https?://maps\.example/(\w+)#', fn( $m, $attr, $url ) => "<div class=\"map\">{$m[1]}</div>" );
$on = $GLOBALS['wp_embed']->shortcode( array(), 'https://maps.example/paris' );
wp_embed_unregister_handler( 'guide' );
return array( $on, $GLOBALS['wp_embed']->shortcode( array(), 'https://maps.example/paris' ) );
