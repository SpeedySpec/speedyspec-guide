<?php
// The URLs of a page of authors; wp_sitemaps_users_pre_url_list and wp_sitemaps_users_pre_max_num_pages can answer instead of querying.
function guide_author_url_list( $url_list, $page_num ) {
	return array( array( 'loc' => "http://example.org/?author=$page_num" ) );
}
add_filter( 'wp_sitemaps_users_pre_url_list', 'guide_author_url_list', 10, 2 );
function guide_three_user_pages() {
	return 3;
}
add_filter( 'wp_sitemaps_users_pre_max_num_pages', 'guide_three_user_pages' );
$users = new WP_Sitemaps_Users();
return array( $users->get_url_list( 2 ), $users->get_max_num_pages() );
