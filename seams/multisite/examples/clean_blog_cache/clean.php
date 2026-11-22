<?php
// Clears a site's caches (by ID, domain and path, its details and meta) and fires clean_site_cache; nothing while cache invalidation is suspended.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_action( 'clean_site_cache', fn( $id ) => print( "clean_site_cache $id\n" ) );
clean_blog_cache( $site );
return wp_cache_get( $site, 'sites' );
