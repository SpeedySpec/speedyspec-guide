<?php
// A meta row by its meta ID, as an object with the value unserialized, or false. update_metadata_by_mid() and delete_metadata_by_mid() change or remove it by ID.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$mid = add_metadata( 'post', $post, 'color', array( 'red' ) );
$row = get_metadata_by_mid( 'post', $mid );
return array( $row->meta_key, $row->meta_value, (int) $row->post_id === $post, get_metadata_by_mid( 'post', 999 ) );
