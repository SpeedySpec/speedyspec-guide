<?php
// Renders the [video] shortcode: a video element with its sources, size and poster for MediaElement.js; wp_video_shortcode_override can replace it.
$html = wp_video_shortcode( array( 'src' => 'http://example.org/clip.mp4', 'width' => 640, 'height' => 360 ) );
return array( str_contains( $html, '<video class="wp-video-shortcode"' ), str_contains( $html, 'width="640"' ), str_contains( $html, 'type="video/mp4"' ) );
