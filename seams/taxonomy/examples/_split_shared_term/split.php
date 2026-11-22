<?php
// Gives one taxonomy's copy of a shared term its own term ID, recording the split in the _split_terms option; split_shared_term fires.
// A term shared between two taxonomies (one term_id, as before 4.2) is made directly in the tables.
$w = $GLOBALS['wpdb'];
$w->insert( $w->terms, array( 'name' => 'Shared', 'slug' => 'shared' ) );
$term = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'category', 'description' => '' ) );
$cat_tt = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'post_tag', 'description' => '' ) );
$tag_tt = $w->insert_id;
function guide_report_split_term( $old, $new, $tt, $tax ) {
	echo "split_shared_term $tax\n";
}
add_action( 'split_shared_term', 'guide_report_split_term', 10, 4 );
$new = _split_shared_term( $term, $tag_tt );
return array( $new !== $term, get_option( '_split_terms' ) == array( $term => array( 'post_tag' => $new ) ), wp_term_is_shared( $term ) );
