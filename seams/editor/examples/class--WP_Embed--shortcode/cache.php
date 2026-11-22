<?php
// The [embed] shortcode: handlers first, then oEmbed, caching the HTML in the post's meta (_oembed_{md5}); the next call uses the cache without a request. A URL nothing can embed is cached as {{unknown}} and becomes a link.
guide_queue_http( array( array( 'type' => 'video', 'version' => '1.0', 'html' => '<iframe src="https://www.youtube.com/embed/abc"></iframe>' ) ) );
$post = guide_post();
guide_view( $post );
$first = $GLOBALS['wp_embed']->shortcode( array(), 'https://www.youtube.com/watch?v=abc' );
$again = $GLOBALS['wp_embed']->shortcode( array(), 'https://www.youtube.com/watch?v=abc' );
$unknown = $GLOBALS['wp_embed']->shortcode( array(), 'https://nothing.example/page' );
$meta = array_values( array_filter( get_post_custom_values( '_oembed_' . md5( 'https://nothing.example/page' . serialize( wp_embed_defaults() ) ), $post ) ?? array() ) );
return array( $first, $again === $first, $unknown, $meta );
