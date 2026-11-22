<?php
// A post's comments feed URL; filtered by post_comments_feed_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
return get_post_comments_feed_link( $id );
