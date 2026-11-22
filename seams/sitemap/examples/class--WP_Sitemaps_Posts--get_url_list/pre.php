<?php
// The URLs of a page of posts; an unsupported post type gives none, and wp_sitemaps_posts_pre_url_list can answer instead of querying.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
function guide_post_url_list( $url_list, $post_type, $page_num ) {
	return array( array( 'loc' => "http://example.org/$post_type-$page_num" ) );
}
add_filter( 'wp_sitemaps_posts_pre_url_list', 'guide_post_url_list', 10, 3 );
$posts = new WP_Sitemaps_Posts();
return array( $posts->get_url_list( 2, 'post' ), $posts->get_url_list( 1, 'nope' ) );
