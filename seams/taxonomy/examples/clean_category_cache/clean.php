<?php
// Clears a category's cache, as clean_term_cache() does for the category taxonomy, so a change made directly in the database shows; rebuilding the category hierarchy loads the terms again at once.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
$GLOBALS['wpdb']->update( $GLOBALS['wpdb']->terms, array( 'name' => 'Renamed' ), array( 'term_id' => $news ) );
$stale = get_category( $news )->name;
clean_category_cache( $news );
return array( $stale, get_category( $news )->name );
