<?php
// Counts a network's sites, not spam, deleted or archived, into its blog_count option.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
update_archived( $site, 1 );
wp_update_network_site_counts();
return get_network_option( 1, 'blog_count' );
