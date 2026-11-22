<?php
// Updates a post: the given fields merged over its current ones, then wp_insert_post(); drafts keep a floating date.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'Renamed' ) );
$post = get_post( $id );
return array( $post->post_title, $post->post_content, $post->post_name );
