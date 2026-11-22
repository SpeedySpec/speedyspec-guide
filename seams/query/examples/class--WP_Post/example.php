<?php
// WP_Post holds a post's fields; get_instance() loads one from the cache or database, filter() gives a copy sanitized for a context, and page_template, post_category, tags_input and ancestors are read on demand.
$cat = wp_insert_term( 'News', 'category' )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Obj', 'post_status' => 'publish', 'post_category' => array( $cat ), 'tags_input' => array( 'red' ) ) );
$post = WP_Post::get_instance( $id );
return array( $post->post_title, $post->post_category === array( $cat ), $post->tags_input, isset( $post->ancestors ), $post->filter( 'display' )->filter, array_key_exists( 'tags_input', $post->to_array() ) );
