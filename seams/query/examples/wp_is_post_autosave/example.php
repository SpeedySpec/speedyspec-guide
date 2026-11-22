<?php
// The parent ID if a post is an autosave, else false.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$autosave = _wp_put_post_revision( array( 'ID' => $id, 'post_title' => 'unsaved' ), true );
return array( wp_is_post_autosave( $autosave ) === $id, wp_is_post_autosave( $id ) );
