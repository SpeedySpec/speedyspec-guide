<?php
// Updates the network's site count when a site is added or deleted (not when it changes); on wp_insert_site and wp_delete_site.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_network_site_counts();
return get_network_option( 1, 'blog_count' );
