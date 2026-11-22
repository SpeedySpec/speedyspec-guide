<?php
// Clears the cache of a site's new domain and path when they change.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_update_site( $site, array( 'path' => '/renamed/' ) );
return get_site_by_path( 'example.org', '/renamed/' )->blog_id == $site;
