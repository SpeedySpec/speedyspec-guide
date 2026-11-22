<?php
// A post's autosave by a user (any user by default), or false.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$none = wp_get_post_autosave( $id );
_wp_put_post_revision( array( 'ID' => $id, 'post_title' => 'unsaved' ), true );
return array( $none, wp_get_post_autosave( $id, 1 )->post_title );
