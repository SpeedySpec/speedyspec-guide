<?php
// Adds __trashed to a trashed post's slug, remembering the old one in _wp_desired_post_slug.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$name = wp_add_trashed_suffix_to_post_name_for_post( get_post( $id ) );
return array( $name, get_post_meta( $id, '_wp_desired_post_slug', true ) );
