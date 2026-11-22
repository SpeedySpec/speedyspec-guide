<?php
// Prints the Underscore templates the playlist script renders its current item and track list with.
$html = guide_render( 'wp_underscore_playlist_templates' );
return array( str_contains( $html, 'id="tmpl-wp-playlist-current-item"' ), str_contains( $html, 'id="tmpl-wp-playlist-item"' ) );
