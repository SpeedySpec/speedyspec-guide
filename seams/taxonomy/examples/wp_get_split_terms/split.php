<?php
// The new term IDs a split old term got, by taxonomy; wp_get_split_term() gives one taxonomy's.
// A term shared between two taxonomies (one term_id, as before 4.2) is made directly in the tables.
$w = $GLOBALS['wpdb'];
$w->insert( $w->terms, array( 'name' => 'Shared', 'slug' => 'shared' ) );
$term = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'category', 'description' => '' ) );
$cat_tt = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'post_tag', 'description' => '' ) );
$tag_tt = $w->insert_id;
$new = _split_shared_term( $term, $tag_tt );
return array( wp_get_split_terms( $term ) == array( 'post_tag' => $new ), wp_get_split_term( $term, 'post_tag' ) == $new, wp_get_split_term( $term, 'category' ) );
