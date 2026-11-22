<?php
// The latest modified date of published posts, never before the latest post date; filtered by get_lastpostmodified.
$id = wp_insert_post( array( 'post_title' => 'D', 'post_status' => 'publish', 'post_date' => '2026-01-05 10:00:00', 'post_date_gmt' => '2026-01-05 10:00:00' ) );
return get_lastpostmodified( 'gmt' ) >= '2026-01-05 10:00:00';
