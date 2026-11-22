<?php
// A post's date as a Unix timestamp, published or modified; false for invalid dates.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
return get_post_timestamp( $id ) === strtotime( '2026-03-15 10:05:06 UTC' );
