<?php
// Puts sites into the cache, by ID and by domain and path, and their meta unless told not to.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$row = get_site( $site );
wp_cache_delete( $site, 'sites' );
update_site_cache( array( $row ) );
return wp_cache_get( $site, 'sites' ) == $row;
