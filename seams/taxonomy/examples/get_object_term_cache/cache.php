<?php
// An object's cached terms in a taxonomy, as WP_Term objects; false when not cached.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$before = get_object_term_cache( $post, 'category' );
update_object_term_cache( $post, 'post' );
return array( $before === false || is_array( $before ), wp_list_pluck( get_object_term_cache( $post, 'category' ), 'name' ) );
