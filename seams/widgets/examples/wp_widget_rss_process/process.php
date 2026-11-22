<?php
// Cleans the RSS widget's settings: item count 1 to 20 (else 10), the URL and title stripped of tags, the flags as integers; with $check_feed it fetches the feed for its link or error.
return wp_widget_rss_process( array( 'items' => 99, 'url' => ' https://feed.example/<b>rss</b> ', 'title' => '<i>News</i>', 'show_date' => '1' ), false );
