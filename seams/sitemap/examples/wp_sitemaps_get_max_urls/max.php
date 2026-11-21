<?php
// 2,000 URLs a sitemap page; wp_sitemaps_max_urls changes it per object type.
add_filter( 'wp_sitemaps_max_urls', fn( $max, $type ) => 'user' === $type ? 50 : $max, 10, 2 );
return array( wp_sitemaps_get_max_urls( 'post' ), wp_sitemaps_get_max_urls( 'user' ) );
