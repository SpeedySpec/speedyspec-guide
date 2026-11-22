<?php
// How many sites the network has, from its blog_count option.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_network_site_counts();
return get_blog_count();
