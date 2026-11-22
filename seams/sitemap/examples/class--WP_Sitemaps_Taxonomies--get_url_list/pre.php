<?php
// The URLs of a page of terms; wp_sitemaps_taxonomies_pre_url_list and wp_sitemaps_taxonomies_pre_max_num_pages can answer instead of querying.
register_taxonomy( 'guide_topic', 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
function guide_term_url_list( $url_list, $taxonomy, $page_num ) {
	return array( array( 'loc' => "http://example.org/?$taxonomy=a" ) );
}
add_filter( 'wp_sitemaps_taxonomies_pre_url_list', 'guide_term_url_list', 10, 3 );
function guide_one_term_page() {
	return 1;
}
add_filter( 'wp_sitemaps_taxonomies_pre_max_num_pages', 'guide_one_term_page' );
$taxonomies = new WP_Sitemaps_Taxonomies();
return array( $taxonomies->get_url_list( 1, 'guide_topic' ), $taxonomies->get_url_list( 1, 'nope' ), $taxonomies->get_max_num_pages(), $taxonomies->get_max_num_pages( 'guide_topic' ) );
