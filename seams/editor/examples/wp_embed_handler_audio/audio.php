<?php
// An audio file URL becomes an [audio] shortcode; wp_embed_handler_audio filters it.
return wp_embed_handler_audio( array(), array(), 'https://example.org/song.mp3', array() );
