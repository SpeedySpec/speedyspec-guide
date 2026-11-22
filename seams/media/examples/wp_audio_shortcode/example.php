<?php
// Renders the [audio] shortcode: an audio element with the file's sources for MediaElement.js, or a link for others; wp_audio_shortcode_override can replace it.
$html = wp_audio_shortcode( array( 'src' => 'http://example.org/song.mp3' ) );
return array( str_contains( $html, '<audio class="wp-audio-shortcode"' ), str_contains( $html, 'type="audio/mpeg"' ) );
