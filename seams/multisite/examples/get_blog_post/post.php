<?php
// A post of another site, switching to it to read.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
switch_to_blog( $site );
$post = wp_insert_post( array( 'post_title' => 'Over there', 'post_status' => 'publish' ) );
restore_current_blog();
return get_blog_post( $site, $post )->post_title;
