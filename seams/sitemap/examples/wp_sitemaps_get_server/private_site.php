<?php
// On a site that discourages search engines, sitemaps are off: no providers are registered.
function guide_discourage_search_engines() {
	return '0';
}
add_filter( 'pre_option_blog_public', 'guide_discourage_search_engines', 20 );
return array( wp_sitemaps_get_server()->sitemaps_enabled(), wp_get_sitemap_providers() );
