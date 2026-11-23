<?php
// Hooked to heartbeat_received: saves the editor's autosave data sent with a heartbeat and answers whether it worked.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$response = heartbeat_autosave( array(), array( 'wp_autosave' => array( 'post_id' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'content' => 'Notes', '_wpnonce' => wp_create_nonce( "update-post_$post" ) ) ) );
return array( $response['wp_autosave']['success'], get_the_title( $post ) );
