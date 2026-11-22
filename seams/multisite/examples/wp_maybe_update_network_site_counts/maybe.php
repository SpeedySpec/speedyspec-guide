<?php
// Updates the site count unless the network is large (more than 10,000 sites) and enable_live_network_counts says no.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_maybe_update_network_site_counts();
return get_network_option( 1, 'blog_count' );
