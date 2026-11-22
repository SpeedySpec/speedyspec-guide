<?php
// Prints a feed widget's items from its saved settings, with titles, summaries, authors and dates as chosen.
guide_queue_http( array() );
update_option( 'dashboard_widget_options', array( 'guide_feed' => array( 'url' => 'https://example.org/feed/', 'items' => 3, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 ) ) );
return guide_render( fn() => wp_dashboard_rss_output( 'guide_feed' ) );
