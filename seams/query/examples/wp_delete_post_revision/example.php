<?php
// Deletes a revision, firing wp_delete_post_revision; the deleted revision, or nothing when the ID isn't a revision.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );

$revision = current( wp_get_post_revisions( $id ) );
$deleted = wp_delete_post_revision( $revision->ID );
return array( $deleted->ID === $revision->ID, wp_get_post_revisions( $id ), wp_delete_post_revision( $id ) );
