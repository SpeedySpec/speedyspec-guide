<?php
// A post's permalink on another site, switching to it to work it out.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
$post = wp_insert_post( array( 'post_title' => 'Over there', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
restore_current_blog();
return get_blog_permalink( $site, $post );
