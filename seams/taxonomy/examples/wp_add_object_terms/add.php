<?php
// Adds terms to an object, keeping its others.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_add_object_terms( $post, 'beta', 'post_tag' );
return wp_get_object_terms( $post, 'post_tag', array( 'fields' => 'names' ) );
