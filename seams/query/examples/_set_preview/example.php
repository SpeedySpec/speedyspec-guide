<?php
// Puts a post's autosave fields in place of its own for a preview.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

_wp_put_post_revision( array( 'ID' => $id, 'post_title' => 'unsaved', 'post_content' => 'draft text' ), true );
$_GET['preview_id'] = $id;
$_GET['preview_nonce'] = wp_create_nonce( 'post_preview_' . $id );
$post = _set_preview( get_post( $id ) );
return array( $post->post_title, $post->post_content );
