<?php
// The revision format version stored in a revision's name, 0 for revisions before version 1.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );

$revision = current( wp_get_post_revisions( $id ) );
return array( $revision->post_name, _wp_get_post_revision_version( $revision ) );
