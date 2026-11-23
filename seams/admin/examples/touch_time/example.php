<?php
// Prints the date and time fields of the publish box: month, day, year, hour and minute.
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:30:00' ) ) );
$html = guide_render( fn() => touch_time( 1, 1 ) );
return array( str_contains( $html, 'name="aa" value="2026"' ), str_contains( $html, 'name="mn" value="30"' ) );
