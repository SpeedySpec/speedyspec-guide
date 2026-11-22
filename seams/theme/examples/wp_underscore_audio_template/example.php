<?php
// Prints the Underscore template of the media library's audio player.
require_once ABSPATH . WPINC . '/media-template.php';
return str_contains( guide_render( 'wp_underscore_audio_template' ), '<audio' );
