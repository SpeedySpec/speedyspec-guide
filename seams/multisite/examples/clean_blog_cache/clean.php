<?php
// Clears a site's caches (by ID, domain and path, its details and meta) and fires clean_site_cache; nothing while cache invalidation is suspended.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
function guide_print_clean_site_cache( $id ) {
	echo "clean_site_cache $id\n";
}
add_action( 'clean_site_cache', 'guide_print_clean_site_cache' );
clean_blog_cache( $site );
return wp_cache_get( $site, 'sites' );
