<?php
// The WP_Query arguments for a post type's sitemap; wp_sitemaps_posts_query_args filters them.
class Guide_Posts extends WP_Sitemaps_Posts { public function args( $t ) { return $this->get_posts_query_args( $t ); } }
function guide_add_post_type_arg( $args, $post_type ) {
	return $args + array( 'guide' => $post_type );
}
add_filter( 'wp_sitemaps_posts_query_args', 'guide_add_post_type_arg', 10, 2 );
return ( new Guide_Posts() )->args( 'post' );
