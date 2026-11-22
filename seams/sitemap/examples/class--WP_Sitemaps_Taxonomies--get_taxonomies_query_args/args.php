<?php
// The WP_Term_Query arguments for a taxonomy's sitemap; wp_sitemaps_taxonomies_query_args filters them.
class Guide_Taxonomies extends WP_Sitemaps_Taxonomies { public function args( $t ) { return $this->get_taxonomies_query_args( $t ); } }
add_filter( 'wp_sitemaps_taxonomies_query_args', fn( $args ) => $args + array( 'guide' => true ) );
return ( new Guide_Taxonomies() )->args( 'category' );
