<?php
// An object's meta: all keys, one key's values, or its first value with $single; a missing key gives the registered default ('' for single, an empty array otherwise). Values are unserialized.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
add_metadata( 'post', $post, 'list', array( 1, 2 ) );
add_metadata( 'post', $post, 'list', 'x' );
register_meta( 'post', 'mood', array( 'single' => true, 'default' => 'calm' ) );
$all = get_metadata( 'post', $post );
return array( get_metadata( 'post', $post, 'list' ), get_metadata( 'post', $post, 'list', true ), get_metadata( 'post', $post, 'missing', true ), get_metadata( 'post', $post, 'mood', true ), array_keys( $all ) );
