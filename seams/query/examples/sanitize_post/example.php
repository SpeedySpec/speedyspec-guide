<?php
// Sanitizes every field of a post (object or array) for a context, marking the context it was filtered for.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$post = sanitize_post( get_post( $id ), 'edit' );
return array( $post->filter, $post->post_title );
