<?php
// Every provider's sitemap pages, at most 50,000; a provider with no pages adds nothing. wp_sitemaps_index_entry filters each entry.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
function guide_two_post_pages() {
	return 2;
}
add_filter( 'wp_sitemaps_posts_pre_max_num_pages', 'guide_two_post_pages' );
function guide_no_user_pages() {
	return 0;
}
add_filter( 'wp_sitemaps_users_pre_max_num_pages', 'guide_no_user_pages' );
function guide_add_lastmod( $entry, $type, $subtype, $page ) {
	return $entry + array( 'lastmod' => "2026-01-0$page" );
}
add_filter( 'wp_sitemaps_index_entry', 'guide_add_lastmod', 10, 4 );
return wp_sitemaps_get_server()->index->get_sitemap_list();
