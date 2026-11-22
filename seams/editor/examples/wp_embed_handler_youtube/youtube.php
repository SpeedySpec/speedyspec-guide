<?php
// Turns a youtube.com/embed/ URL into the watch URL and embeds that through oEmbed; wp_embed_handler_youtube filters the result.
guide_queue_http( array( array( 'type' => 'video', 'version' => '1.0', 'html' => '<iframe src="https://www.youtube.com/embed/abc"></iframe>' ) ) );
wp_maybe_load_embeds();
return $GLOBALS['wp_embed']->shortcode( array(), 'https://www.youtube.com/embed/abc' );
