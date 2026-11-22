<?php
// Inserts a revision or autosave of a post from its data; fires _wp_put_post_revision with the revision's ID.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$revision = _wp_put_post_revision( array( 'ID' => $id, 'post_title' => 'snapshot', 'post_content' => 'x' ) );
$post = get_post( $revision );
return array( $post->post_type, $post->post_parent === $id, $post->post_title, did_action( '_wp_put_post_revision' ) );
