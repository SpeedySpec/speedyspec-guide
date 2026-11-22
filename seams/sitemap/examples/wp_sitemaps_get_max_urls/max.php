<?php
// 2,000 URLs a sitemap page; wp_sitemaps_max_urls changes it per object type.
function guide_fewer_user_urls( $max_urls, $object_type ) {
	return 'user' === $object_type ? 50 : $max_urls;
}
add_filter( 'wp_sitemaps_max_urls', 'guide_fewer_user_urls', 10, 2 );
return array( wp_sitemaps_get_max_urls( 'post' ), wp_sitemaps_get_max_urls( 'user' ) );
