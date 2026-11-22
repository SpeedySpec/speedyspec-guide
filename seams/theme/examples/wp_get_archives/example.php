<?php
// Archive links by year, month, week, day, post or alpha, with counts and limits, printed or given; filtered by getarchives_where and getarchives_join.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
wp_insert_post( array( 'post_title' => 'Older', 'post_status' => 'publish', 'post_date' => '2025-12-01 00:00:00' ) );
return array( wp_get_archives( array( 'type' => 'monthly', 'echo' => false, 'show_post_count' => true ) ), wp_get_archives( array( 'type' => 'yearly', 'format' => 'option', 'echo' => false ) ) );
