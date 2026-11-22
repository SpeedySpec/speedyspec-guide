<?php
// Meta without defaults: null for a missing key, so a default can be told apart; get_{$meta_type}_metadata can answer first, and the object's meta cache is filled on first read.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
add_filter( 'get_post_metadata', fn( $pre, $id, $key ) => 'forced' === $key ? array( 'short-circuit' ) : $pre, 10, 3 );
return array( get_metadata_raw( 'post', $post, 'missing', true ), get_metadata_raw( 'post', $post, 'forced', true ), get_metadata_raw( 'post', 0, 'x' ) );
