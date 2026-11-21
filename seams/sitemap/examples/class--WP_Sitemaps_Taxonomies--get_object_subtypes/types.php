<?php
// Public, viewable taxonomies; wp_sitemaps_taxonomies filters them. With none, the taxonomies provider has no pages.
register_taxonomy( 'guide_topic', 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_taxonomy( 'guide_hidden', 'post', array( 'public' => false, 'rewrite' => false, 'query_var' => false ) );
$taxonomies = new WP_Sitemaps_Taxonomies();
$types = array_keys( $taxonomies->get_object_subtypes() );
add_filter( 'wp_sitemaps_taxonomies', fn() => array() );
return array( $types, $taxonomies->get_sitemap_entries() );
