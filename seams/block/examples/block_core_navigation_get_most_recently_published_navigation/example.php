<?php
// The newest published wp_navigation post, or null.
wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'Old', 'post_status' => 'publish', 'post_date' => '2026-01-01 00:00:00' ) );
wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'New', 'post_status' => 'publish', 'post_date' => '2026-02-01 00:00:00' ) );
return block_core_navigation_get_most_recently_published_navigation()->post_title;
