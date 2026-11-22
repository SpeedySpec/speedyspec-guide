<?php
// A term by ID or object (in a taxonomy when given), as a WP_Term, array or with a filter context; get_term and get_{$taxonomy} filter it. A term of a shared ID in another taxonomy, or a missing term, gives null; a missing taxonomy an error.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
function guide_mark_category_filtered( $term ) {
	$term->extra = 'filtered';
	return $term;
}
add_filter( 'get_category', 'guide_mark_category_filtered' );
$term = get_term( $news['term_id'] );
return array( $term->name, $term->extra, get_term( $news['term_id'], 'category', ARRAY_A )['slug'], get_term( $news['term_id'], 'post_tag' ), get_term( 999 ), get_term( 1, 'nope' )->get_error_code() );
