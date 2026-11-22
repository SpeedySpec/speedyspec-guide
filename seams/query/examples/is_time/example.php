<?php
// Whether the main query is for a time archive: an hour, minute or second.
wp_insert_post( array( 'post_title' => 'Dated', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:30:00' ) );
guide_go( '/?m=2026031510' );
return array( is_time(), is_day() );
