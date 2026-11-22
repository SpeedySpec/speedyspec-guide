<?php
// Hooked to wp_save_post_revision_post_has_changed: a post also counts as changed when a revisioned meta value differs from the last revision's.
register_post_meta( 'post', 'guide_note', array( 'single' => true, 'type' => 'string', 'revisions_enabled' => true ) );
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'meta_input' => array( 'guide_note' => 'a' ) ) );
$last = get_post( wp_save_post_revision( $id ) ?: current( wp_get_post_revisions( $id ) )->ID );
$same = wp_check_revisioned_meta_fields_have_changed( false, $last, get_post( $id ) );
update_post_meta( $id, 'guide_note', 'b' );
return array( $same, wp_check_revisioned_meta_fields_have_changed( false, $last, get_post( $id ) ) );
