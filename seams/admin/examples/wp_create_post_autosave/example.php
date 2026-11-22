<?php
// Saves the editor's unsaved changes as the user's autosave revision of a published post; gives its ID or an error.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$id = wp_create_post_autosave( array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'post_content' => 'Draft text' ) );
return array( get_post_type( $id ), get_the_title( $id ), wp_get_post_autosave( $post )->ID === $id );
