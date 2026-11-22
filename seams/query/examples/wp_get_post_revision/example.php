<?php
// A revision as a post object, or null when the ID isn't a revision.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );

$revision = current( wp_get_post_revisions( $id ) );
return array( wp_get_post_revision( $revision->ID )->post_title, wp_get_post_revision( $id ) );
