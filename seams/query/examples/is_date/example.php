<?php
// Whether the main query is for a date archive: a year, month, day or time.
wp_insert_post( array( 'post_title' => 'Dated', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:30:00' ) );
guide_go( '/?m=2026' );
return array( is_date(), is_year(), is_month() );
