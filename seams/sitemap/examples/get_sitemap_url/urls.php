<?php
// The URL of the index or of a provider's page; an unknown provider or subtype gives false, and a page under 1 is page 1.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
$plain = array( get_sitemap_url( 'index' ), get_sitemap_url( 'posts', 'post', 0 ), get_sitemap_url( 'users', '', 3 ), get_sitemap_url( 'nope' ), get_sitemap_url( 'posts', 'nope' ) );
guide_pretty_permalinks();
return array( $plain, get_sitemap_url( 'index' ), get_sitemap_url( 'posts', 'post', 2 ) );
