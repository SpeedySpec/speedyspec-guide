<?php
// Updates a network's site and user counts.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
wp_update_network_counts();
return array( get_network_option( 1, 'blog_count' ), get_network_option( 1, 'user_count' ) );
