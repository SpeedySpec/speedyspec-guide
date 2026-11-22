<?php
// A post as a WP_Post, array or list, by ID or object, filtered for a context; the global post when empty; null when it doesn't exist.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$post = get_post( $id );
return array( get_class( $post ), $post->post_title, get_post( $id, ARRAY_A )['post_status'], get_post( 999 ) );
