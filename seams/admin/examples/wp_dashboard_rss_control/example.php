<?php
// Prints, and saves, the settings form of a feed widget: its URL, title, item count and what to show.
$html = guide_render( fn() => wp_dashboard_rss_control( 'guide_feed', array() ) );
return array( str_contains( $html, 'rss-url-' ), str_contains( $html, 'rss-items-' ) );
