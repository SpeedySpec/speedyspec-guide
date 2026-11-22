<?php
// Hooked to posts_pre_query while a random request runs: picks one eligible post among the sampled IDs (up to three samples), else from a cached pool of up to 1,000 eligible posts; never writes to the database.
$a = wp_insert_post( array( 'post_title' => 'Only one', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Draft' ) );
$GLOBALS['wp']->query_vars = array( 'random' => '' );
add_action( 'pre_get_posts', 'wp_random_content_pre_get_posts', 20 );
foreach ( array( 'posts_where', 'posts_orderby', 'post_limits', 'posts_fields', 'posts_pre_query' ) as $hook ) {
	add_filter( $hook, 'wp_random_content_' . $hook, 20, 2 );
}
$q = new WP_Query();
$GLOBALS['wp_the_query'] = $q;
$posts = $q->query( array( 'random' => '' ) );
return array_map( 'get_the_title', $posts );
