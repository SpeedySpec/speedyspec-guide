<?php
// Hooked to _wp_put_post_revision: copies the post's revisioned meta (keys registered with revisions_enabled) to the new revision.
register_post_meta( 'post', 'guide_note', array( 'single' => true, 'type' => 'string', 'revisions_enabled' => true ) );
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'meta_input' => array( 'guide_note' => 'kept' ) ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2' ) );
$revision = current( wp_get_post_revisions( $id ) );
return get_metadata( 'post', $revision->ID, 'guide_note', true );
