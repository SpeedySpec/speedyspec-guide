<?php
// A calendar of a month with days linked to their posts and links to the months around it, cached; printed unless display is false; filtered by get_calendar.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( '/?m=202603' );
$html = get_calendar( array( 'display' => false ) );
return array( str_contains( $html, 'wp-calendar' ), str_contains( $html, '?m=20260315' ), str_contains( $html, 'March 2026' ) );
