<?php
// Whether the main query is for a month's archive.
wp_insert_post( array( 'post_title' => 'Dated', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:30:00' ) );
guide_go( '/?m=202603' );
return array( is_month(), is_day() );
