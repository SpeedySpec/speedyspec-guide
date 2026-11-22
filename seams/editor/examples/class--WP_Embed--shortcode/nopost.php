<?php
// Outside a post, oEmbed results are cached in an oembed_cache post named after the cache key.
guide_queue_http( array( array( 'type' => 'video', 'version' => '1.0', 'html' => '<iframe src="https://www.youtube.com/embed/abc"></iframe>' ) ) );
$html = $GLOBALS['wp_embed']->shortcode( array( 'width' => 300 ), 'https://www.youtube.com/watch?v=abc' );
$cached = get_posts( array( 'post_type' => 'oembed_cache', 'post_status' => 'publish' ) );
return array( $html, count( $cached ), $cached[0]->post_content );
