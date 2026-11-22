<?php
// Registers the built-in handlers: YouTube embed URLs, and audio and video files by extension; load_default_embeds can turn it off.
wp_maybe_load_embeds();
$handlers = array();
foreach ( $GLOBALS['wp_embed']->handlers as $priority => $list ) { foreach ( $list as $id => $h ) { $handlers[] = "$priority $id"; } }
return array( $handlers, $GLOBALS['wp_embed']->shortcode( array(), 'https://example.org/song.mp3' ) );
