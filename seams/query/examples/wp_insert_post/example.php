<?php
// Inserts or updates a post from its fields: defaults filled, slug made unique, dates resolved, author, terms, meta (meta_input) and template saved; fires save_post, wp_insert_post and wp_after_insert_post. The ID, or 0 or an error.
$id = wp_insert_post( array( 'post_title' => 'New one', 'post_content' => 'x', 'post_status' => 'publish', 'meta_input' => array( 'color' => 'red' ), 'tags_input' => array( 'fresh' ) ) );
$empty = wp_insert_post( array( 'post_title' => '', 'post_content' => '' ), true );
$post = get_post( $id );
return array( $post->post_name, $post->post_author, get_post_meta( $id, 'color', true ), wp_get_post_tags( $id, array( 'fields' => 'names' ) ), $empty->get_error_code(), did_action( 'wp_after_insert_post' ) );
