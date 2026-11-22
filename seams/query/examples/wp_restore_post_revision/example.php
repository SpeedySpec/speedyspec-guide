<?php
// Restores a post to a revision's fields (and revisioned meta, on wp_restore_post_revision); the post's ID.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );

$revisions = wp_get_post_revisions( $id, array( 'order' => 'ASC' ) );
$oldest = reset( $revisions );
wp_restore_post_revision( $oldest->ID );
return array( $oldest->post_title, get_post( $id )->post_title, did_action( 'wp_restore_post_revision' ) );
