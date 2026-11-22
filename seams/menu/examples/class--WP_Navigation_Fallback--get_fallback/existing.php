<?php
// The most recently published wp_navigation post. With none and wp_navigation_should_create_fallback false, there is no fallback.
add_filter( 'wp_navigation_should_create_fallback', '__return_false' );
$none = WP_Navigation_Fallback::get_fallback();
wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'Old', 'post_status' => 'publish', 'post_date' => '2026-01-01 00:00:00' ) );
wp_insert_post( array( 'post_type' => 'wp_navigation', 'post_title' => 'New', 'post_status' => 'publish', 'post_date' => '2026-02-01 00:00:00' ) );
return array( $none, WP_Navigation_Fallback::get_fallback()->post_title );
