<?php
// A post's data shaped as a revision of it: its revisioned fields, parent, type revision, status inherit, and a name for an autosave or revision.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$data = _wp_post_revision_data( get_post( $id ), true );
return array( $data['post_title'], $data['post_type'], $data['post_status'], $data['post_parent'] === $id, $data['post_name'] === "$id-autosave-v1" );
