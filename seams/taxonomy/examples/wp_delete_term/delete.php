<?php
// Deletes a term: its children move to its parent, its objects keep their other terms (posts left without a category get the default), and a taxonomy's default term can't be deleted (0). delete_term, delete_{$taxonomy} and related actions fire; true, or false for a missing term.
$default = wp_insert_term( 'Uncategorized', 'category' )['term_id'];
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_action( 'delete_category', fn( $id ) => print( "delete_category $id\n" ) );
$deleted = wp_delete_term( $news['term_id'], 'category' );
return array( $deleted, get_term( $local['term_id'] )->parent, wp_delete_term( $default, 'category' ), wp_delete_term( 999, 'category' ) );
