<?php
// Hooked to comments_open and pings_open: false for posts older than close_comments_days_old when close_comments_for_old_posts is on.
update_option( 'close_comments_for_old_posts', 1 );
update_option( 'close_comments_days_old', 14 );
$old = wp_insert_post( array( 'post_title' => 'Old', 'post_status' => 'publish', 'post_date' => '2020-01-01 00:00:00' ) );
$new = wp_insert_post( array( 'post_title' => 'New', 'post_status' => 'publish' ) );
return array( _close_comments_for_old_post( true, $old ), _close_comments_for_old_post( true, $new ) );
