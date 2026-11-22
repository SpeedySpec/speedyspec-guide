<?php
// A post's last modified date in a format; filtered by get_the_modified_date.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
return get_the_modified_date( 'Y-m-d', $id );
