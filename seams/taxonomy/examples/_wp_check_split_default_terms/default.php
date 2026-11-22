<?php
// After a split, moves the default_category (or other default term) option to the term's new ID.
// A term shared between two taxonomies (one term_id, as before 4.2) is made directly in the tables.
$w = $GLOBALS['wpdb'];
$w->insert( $w->terms, array( 'name' => 'Shared', 'slug' => 'shared' ) );
$term = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'category', 'description' => '' ) );
$cat_tt = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'post_tag', 'description' => '' ) );
$tag_tt = $w->insert_id;
update_option( 'default_category', $term );
_wp_check_split_default_terms( $term, 999, $cat_tt, 'category' );
return get_option( 'default_category' );
