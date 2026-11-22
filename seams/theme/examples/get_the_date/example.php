<?php
// A post's date in a format, the site's date_format by default; filtered by get_the_date.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
update_option( 'date_format', 'F j, Y' );
return array( get_the_date( '', $id ), get_the_date( 'D', $id ) );
