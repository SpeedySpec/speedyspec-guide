<?php
// Saves a post from the edit form's submitted fields: its content, meta, terms, sticky state and status; gives the post ID.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$id = edit_post( array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'content' => 'Steep briefly.', 'user_ID' => 1 ) );
return array( $id === $post, get_the_title( $post ), get_post_field( 'post_content', $post ) );
