<?php
// Prints the news feeds of the Events and News widget, each with its item count.
guide_queue_http( array() );
$html = guide_render( fn() => wp_dashboard_primary_output( 'dashboard_primary', array( 'news' => array( 'link' => 'https://wordpress.org/news/', 'url' => 'https://wordpress.org/news/feed/', 'title' => 'News', 'items' => 2, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 ) ) ) );
return str_contains( $html, 'rss-widget' );
