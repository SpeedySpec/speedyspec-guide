<?php
// A user's newest published post across their sites, with its blog_id, post_id, post_date_gmt and post_gmt_ts.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_user_to_blog( $site, 1, 'administrator' );
wp_insert_post( array( 'post_title' => 'Old', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
switch_to_blog( $site );
wp_insert_post( array( 'post_title' => 'New', 'post_status' => 'publish', 'post_date' => '2026-03-05 09:00:00' ) );
restore_current_blog();
$recent = get_most_recent_post_of_user( 1 );
return array( $recent['blog_id'], $recent['post_date_gmt'] );
