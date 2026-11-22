<?php
// A page's URL from the provider's name, the subtype and the page, with plain or pretty permalinks.
$posts = new WP_Sitemaps_Posts();
$plain = $posts->get_sitemap_url( 'post', 2 );
guide_pretty_permalinks();
return array( $plain, $posts->get_sitemap_url( 'post', 2 ), ( new WP_Sitemaps_Users() )->get_sitemap_url( '', 1 ) );
