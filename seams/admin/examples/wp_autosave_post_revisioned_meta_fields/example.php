<?php
// Copies the submitted values of meta keys kept with revisions to an autosave.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
register_post_meta( 'post', 'tasting', array( 'single' => true, 'revisions_enabled' => true, 'show_in_rest' => true ) );
$autosave = wp_create_post_autosave( array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Tea', 'post_content' => 'x' ) );
$_POST['tasting'] = 'Grassy';
wp_autosave_post_revisioned_meta_fields( get_post( $autosave, ARRAY_A ) );
return get_metadata( 'post', $autosave, 'tasting', true );
