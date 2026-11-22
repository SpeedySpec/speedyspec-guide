<?php
// The network's recently updated public sites, newest first, as blog_id, domain, path and last_updated.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_site( $site, array( 'last_updated' => '2026-03-05 09:00:00' ) );
return wp_list_pluck( get_last_updated(), 'path' );
