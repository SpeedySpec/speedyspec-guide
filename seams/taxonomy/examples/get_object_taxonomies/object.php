<?php
// The taxonomies of a post type (or a post, attachment MIME types included), as names or objects.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( get_object_taxonomies( 'post' ), get_object_taxonomies( get_post( $post ) ), get_object_taxonomies( 'page' ), array_keys( get_object_taxonomies( 'post', 'objects' ) ) );
