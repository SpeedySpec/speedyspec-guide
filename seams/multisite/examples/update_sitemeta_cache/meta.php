<?php
// Loads sites' meta into the cache; nothing without site meta support.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_site_meta( $site, 'color', 'blue' );
wp_cache_delete( $site, 'blog_meta' );
update_sitemeta_cache( array( $site ) );
return wp_cache_get( $site, 'blog_meta' );
