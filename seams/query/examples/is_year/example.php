<?php
// Whether the main query is for a year's archive.
wp_insert_post( array( 'post_title' => 'Dated', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:30:00' ) );
guide_go( '/?year=2026' );
return array( is_year(), is_month() );
