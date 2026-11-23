<?php
// Prints the On This Day widget: posts published on today's date in earlier years.
$last_year = gmdate( 'Y-m-d H:i:s', strtotime( '-1 year' ) );
wp_insert_post( array( 'post_title' => 'A year ago', 'post_status' => 'publish', 'post_date' => $last_year, 'post_date_gmt' => $last_year ) );
return str_contains( guide_render( fn() => wp_dashboard_on_this_day() ), 'A year ago' );
