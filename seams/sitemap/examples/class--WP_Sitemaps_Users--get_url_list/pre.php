<?php
// The URLs of a page of authors; wp_sitemaps_users_pre_url_list and wp_sitemaps_users_pre_max_num_pages can answer instead of querying.
add_filter( 'wp_sitemaps_users_pre_url_list', fn( $list, $page ) => array( array( 'loc' => "http://example.org/?author=$page" ) ), 10, 2 );
add_filter( 'wp_sitemaps_users_pre_max_num_pages', fn() => 3 );
$users = new WP_Sitemaps_Users();
return array( $users->get_url_list( 2 ), $users->get_max_num_pages() );
