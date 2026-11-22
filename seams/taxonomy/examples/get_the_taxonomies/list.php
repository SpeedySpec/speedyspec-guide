<?php
// For a post, each taxonomy's label and its linked terms ('Categories: <a>Local</a>.'), by taxonomy name; an empty array for no post.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( get_the_taxonomies( $post ), get_the_taxonomies( 999 ) );
