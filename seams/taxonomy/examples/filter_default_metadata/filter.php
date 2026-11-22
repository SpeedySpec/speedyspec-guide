<?php
// On default_{$meta_type}_metadata, gives a registered key's default (for the object's subtype first); single keys get the value, others it in an array.
register_meta( 'post', 'mood', array( 'single' => true, 'default' => 'calm' ) );
register_meta( 'post', 'tags', array( 'default' => 'none' ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
return array( filter_default_metadata( '', $post, 'mood', true, 'post' ), filter_default_metadata( array(), $post, 'tags', false, 'post' ), filter_default_metadata( 'kept', $post, 'nope', true, 'post' ) );
