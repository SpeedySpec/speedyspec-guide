<?php
// A post's time in a format, the site's time_format by default; filtered by get_the_time.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
return array( get_the_time( '', $id ), get_the_time( 'H:i:s', $id ), get_the_time( 'U', $id ) );
