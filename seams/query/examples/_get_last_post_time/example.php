<?php
// The latest date or modified date of public posts, in a time zone and of types, cached.
wp_insert_post( array( 'post_title' => 'D', 'post_status' => 'publish', 'post_date' => '2026-01-05 10:00:00', 'post_date_gmt' => '2026-01-05 10:00:00' ) );
return array( _get_last_post_time( 'gmt', 'date' ), _get_last_post_time( 'gmt', 'date', 'page' ) );
