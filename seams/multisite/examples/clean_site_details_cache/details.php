<?php
// Clears a site's cached details.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
get_blog_details( $site );
clean_site_details_cache( $site );
return wp_cache_get( $site, 'site-details' );
