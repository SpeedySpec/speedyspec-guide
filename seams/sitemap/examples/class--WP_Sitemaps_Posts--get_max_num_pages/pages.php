<?php
// No subtype: 0 pages; wp_sitemaps_posts_pre_max_num_pages can answer instead of counting.
function guide_four_pages( $max_num_pages, $post_type ) {
	return 4;
}
add_filter( 'wp_sitemaps_posts_pre_max_num_pages', 'guide_four_pages', 10, 2 );
$posts = new WP_Sitemaps_Posts();
return array( $posts->get_max_num_pages(), $posts->get_max_num_pages( 'post' ) );
