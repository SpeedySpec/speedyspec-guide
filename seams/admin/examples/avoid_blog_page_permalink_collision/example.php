<?php
// Hooked to wp_insert_post_data on a subdirectory network's main site: renames a page whose slug would clash with a site's path.
$site = wpmu_create_blog( 'example.org', '/tea/', 'Tea', 1 );
$data = avoid_blog_page_permalink_collision( array( 'post_type' => 'page', 'post_name' => 'tea', 'post_status' => 'publish', 'post_parent' => 0 ), array( 'ID' => 0 ) );
return $data['post_name'];
