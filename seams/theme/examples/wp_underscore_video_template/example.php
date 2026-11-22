<?php
// Prints the Underscore template of the media library's video player.
require_once ABSPATH . WPINC . '/media-template.php';
return str_contains( guide_render( 'wp_underscore_video_template' ), '<video' );
