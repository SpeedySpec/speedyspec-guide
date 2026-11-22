<?php
// The WP_Query arguments for a post type's sitemap; wp_sitemaps_posts_query_args filters them.
class Guide_Posts extends WP_Sitemaps_Posts { public function args( $t ) { return $this->get_posts_query_args( $t ); } }
add_filter( 'wp_sitemaps_posts_query_args', fn( $args, $type ) => $args + array( 'guide' => $type ), 10, 2 );
return ( new Guide_Posts() )->args( 'post' );
