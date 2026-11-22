<?php
// A post's date and time in a format, local or GMT, translated or not; filtered by get_post_time.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
return array( get_post_time( 'Y-m-d H:i', false, $id ), get_post_time( 'Y-m-d H:i', true, $id ) );
