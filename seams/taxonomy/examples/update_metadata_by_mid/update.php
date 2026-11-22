<?php
// Changes a meta row's value (and key when given) by its meta ID; false for a missing ID.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$mid = add_metadata( 'post', $post, 'color', 'red' );
$changed = update_metadata_by_mid( 'post', $mid, 'blue', 'colour' );
return array( $changed, get_metadata( 'post', $post, 'colour' ), get_metadata( 'post', $post, 'color' ), update_metadata_by_mid( 'post', 999, 'x' ) );
