<?php
// The WP_Term_Query arguments for a taxonomy's sitemap; wp_sitemaps_taxonomies_query_args filters them.
class Guide_Taxonomies extends WP_Sitemaps_Taxonomies { public function args( $t ) { return $this->get_taxonomies_query_args( $t ); } }
function guide_add_guide_arg( $args ) {
	return $args + array( 'guide' => true );
}
add_filter( 'wp_sitemaps_taxonomies_query_args', 'guide_add_guide_arg' );
return ( new Guide_Taxonomies() )->args( 'category' );
