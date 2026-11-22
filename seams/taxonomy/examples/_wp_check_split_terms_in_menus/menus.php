<?php
// After a split, points menu items at the term's new ID in that taxonomy.
// A term shared between two taxonomies (one term_id, as before 4.2) is made directly in the tables.
$w = $GLOBALS['wpdb'];
$w->insert( $w->terms, array( 'name' => 'Shared', 'slug' => 'shared' ) );
$term = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'category', 'description' => '' ) );
$cat_tt = $w->insert_id;
$w->insert( $w->term_taxonomy, array( 'term_id' => $term, 'taxonomy' => 'post_tag', 'description' => '' ) );
$tag_tt = $w->insert_id;
$item = wp_insert_post( array( 'post_type' => 'nav_menu_item', 'post_status' => 'publish' ) );
update_post_meta( $item, '_menu_item_type', 'taxonomy' );
update_post_meta( $item, '_menu_item_object', 'post_tag' );
update_post_meta( $item, '_menu_item_object_id', $term );
_wp_check_split_terms_in_menus( $term, 999, $tag_tt, 'post_tag' );
return get_post_meta( $item, '_menu_item_object_id', true );
