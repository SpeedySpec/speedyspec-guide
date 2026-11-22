<?php
// The date of the latest published post, in a time zone (server, blog or GMT) and of a type; filtered by get_lastpostdate.
wp_insert_post( array( 'post_title' => 'D', 'post_status' => 'publish', 'post_date' => '2026-01-05 10:00:00', 'post_date_gmt' => '2026-01-05 10:00:00' ) );
return get_lastpostdate( 'gmt' );
