<?php
// Loads sites (and their meta, unless told not to) into the cache, those not cached yet, in one query.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
wp_cache_delete( $site, 'sites' );
_prime_site_caches( array( $site ) );
return wp_cache_get( $site, 'sites' )->path;
