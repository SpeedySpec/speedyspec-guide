<?php
// Adds an oEmbed provider by URL pattern (a wildcard format, or a regex with $regex true); before plugins_loaded it is queued for WP_oEmbed to add.
do_action( 'plugins_loaded' );
wp_oembed_add_provider( 'https://*.clips.example/*', 'https://clips.example/oembed' );
wp_oembed_add_provider( '#https?://(www\.)?films\.example/.*#i', 'https://films.example/oembed', true );
return array( _wp_oembed_get_object()->get_provider( 'https://a.clips.example/1', array( 'discover' => false ) ), _wp_oembed_get_object()->get_provider( 'https://films.example/x', array( 'discover' => false ) ) );
