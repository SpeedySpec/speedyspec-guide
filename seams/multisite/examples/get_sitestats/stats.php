<?php
// The network's site and user counts, from wp_update_network_counts().
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_network_counts();
return get_sitestats();
