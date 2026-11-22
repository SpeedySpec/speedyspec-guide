<?php
// The published posts from today's date in earlier years, for the On This Day widget.
$last_year = gmdate( 'Y-m-d H:i:s', strtotime( '-1 year' ) );
wp_insert_post( array( 'post_title' => 'A year ago', 'post_status' => 'publish', 'post_date' => $last_year, 'post_date_gmt' => $last_year ) );
return wp_list_pluck( wp_dashboard_on_this_day_get_posts(), 'post_title' );
