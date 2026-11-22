<?php
// Whether an object has any of terms (IDs, names or slugs) in a taxonomy, or any term with none given.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( is_object_in_term( $post, 'category', $local['term_id'] ), is_object_in_term( $post, 'category', 'News' ), is_object_in_term( $post, 'post_tag', array( 'alpha', 'beta' ) ), is_object_in_term( $post, 'post_tag' ), is_object_in_term( $post, 'nope' )->get_error_code() );
