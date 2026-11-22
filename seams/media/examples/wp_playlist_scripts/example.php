<?php
// Enqueues the playlist's style and script and prints its Underscore templates in the footer.
wp_playlist_scripts( 'audio' );
return array( wp_script_is( 'wp-playlist', 'enqueued' ), false !== has_action( 'wp_footer', 'wp_underscore_playlist_templates' ) );
