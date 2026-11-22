<?php
// An object's values for its registered meta keys only (or one key's value), using the object's subtype.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
register_meta( 'post', 'mood', array( 'single' => true, 'object_subtype' => 'post' ) );
add_metadata( 'post', $post, 'mood', 'happy' );
add_metadata( 'post', $post, 'unregistered', 'x' );
return array( get_registered_metadata( 'post', $post ), get_registered_metadata( 'post', $post, 'mood' ), get_registered_metadata( 'post', $post, 'unregistered' ) );
