<?php
// Defers term count updates until turned off again, when the queued counts are updated at once.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_defer_term_counting( true );
wp_set_object_terms( $post, 'beta', 'post_tag', true );
$while = get_term_by( 'slug', 'beta', 'post_tag' )->count;
wp_defer_term_counting( false );
clean_term_cache( get_term_by( 'slug', 'beta', 'post_tag' )->term_id, 'post_tag' );
return array( $while, get_term_by( 'slug', 'beta', 'post_tag' )->count, wp_defer_term_counting() );
