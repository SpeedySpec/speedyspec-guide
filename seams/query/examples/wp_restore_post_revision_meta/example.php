<?php
// Hooked to wp_restore_post_revision: copies a revision's revisioned meta back to its post.
register_post_meta( 'post', 'guide_note', array( 'single' => true, 'type' => 'string', 'revisions_enabled' => true ) );
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'meta_input' => array( 'guide_note' => 'first' ) ) );
$revision = wp_save_post_revision( $id ) ?: current( wp_get_post_revisions( $id ) )->ID;
update_post_meta( $id, 'guide_note', 'changed' );
wp_restore_post_revision_meta( $id, $revision );
return get_post_meta( $id, 'guide_note', true );
