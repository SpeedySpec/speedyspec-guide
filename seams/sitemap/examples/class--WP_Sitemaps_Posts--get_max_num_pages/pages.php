<?php
// No subtype: 0 pages; wp_sitemaps_posts_pre_max_num_pages can answer instead of counting.
add_filter( 'wp_sitemaps_posts_pre_max_num_pages', fn( $n, $type ) => 4, 10, 2 );
$posts = new WP_Sitemaps_Posts();
return array( $posts->get_max_num_pages(), $posts->get_max_num_pages( 'post' ) );
