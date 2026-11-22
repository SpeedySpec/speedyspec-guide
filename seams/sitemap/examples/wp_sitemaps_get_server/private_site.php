<?php
// On a site that discourages search engines, sitemaps are off: no providers are registered.
add_filter( 'pre_option_blog_public', fn() => '0', 20 );
return array( wp_sitemaps_get_server()->sitemaps_enabled(), wp_get_sitemap_providers() );
