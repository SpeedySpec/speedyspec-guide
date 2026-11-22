<?php
// Deletes a meta row by its meta ID; false for a missing ID.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$mid = add_metadata( 'post', $post, 'color', 'red' );
return array( delete_metadata_by_mid( 'post', $mid ), get_metadata( 'post', $post, 'color' ), delete_metadata_by_mid( 'post', $mid ) );
