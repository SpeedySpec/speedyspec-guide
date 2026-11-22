<?php
// Splits shared terms in batches of 10 under a lock, scheduling the next batch until none are left (then finished_splitting_shared_terms).
// A term shared between two taxonomies (one term_id, as before 4.2) is made directly in the tables.
$w = $GLOBALS['wpdb'];
$w->insert( $w->terms, array( 'name' => 'Shared', 'slug' => 'shared' ) );
$term = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'category', 'description' => '' ) );
$cat_tt = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'post_tag', 'description' => '' ) );
$tag_tt = $w->insert_id;
_wp_batch_split_terms();
return array( wp_term_is_shared( $term ), get_option( 'finished_splitting_shared_terms' ) );
