<?php
// A term query: arguments over the defaults (get_terms_defaults), SQL built and cached by last_changed, terms returned in the fields asked for. parse_term_query and pre_get_terms fire; terms_clauses, terms_pre_query and get_terms_orderby filter it.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
function guide_report_term_query( $q ) {
	echo "pre_get_terms\n";
}
add_action( 'pre_get_terms', 'guide_report_term_query' );
$query = new WP_Term_Query();
$names = $query->query( array( 'taxonomy' => 'category', 'hide_empty' => false, 'orderby' => 'name', 'fields' => 'id=>name' ) );
$slugs = ( new WP_Term_Query( array( 'taxonomy' => 'category', 'hide_empty' => false, 'parent' => 0, 'fields' => 'slugs' ) ) )->terms;
$search = ( new WP_Term_Query( array( 'taxonomy' => 'category', 'hide_empty' => false, 'search' => 'loc', 'fields' => 'names' ) ) )->terms;
return array( array_values( $names ), $slugs, $search, array_key_exists( 'hide_empty', $query->query_var_defaults ) );
