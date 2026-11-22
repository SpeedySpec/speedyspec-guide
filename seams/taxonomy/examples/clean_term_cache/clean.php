<?php
// Clears terms' cache and their taxonomy's (rebuilding a hierarchical one's children at once); clean_term_cache fires.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
function guide_report_cleaned_terms( $ids, $tax ) {
	echo "clean_term_cache $tax\n";
}
add_action( 'clean_term_cache', 'guide_report_cleaned_terms', 10, 2 );
clean_term_cache( $news['term_id'], 'category' );
return get_option( 'category_children' );
