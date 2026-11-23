<?php
// Saves autosave data from the Heartbeat API: updates a draft of the user's own, or saves an autosave revision; gives the ID or an error.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$id = wp_autosave( array( 'post_id' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'content' => 'Notes', '_wpnonce' => wp_create_nonce( "update-post_$post" ) ) );
return array( $id === $post, get_the_title( $post ) );
