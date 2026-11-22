<?php
// A video file URL becomes a [video] shortcode, with the width and height given to the embed; wp_embed_handler_video filters it.
return array( wp_embed_handler_video( array(), array(), 'https://example.org/clip.mp4', array( 'width' => 640, 'height' => 360 ) ), wp_embed_handler_video( array(), array(), 'https://example.org/clip.mp4', array() ) );
