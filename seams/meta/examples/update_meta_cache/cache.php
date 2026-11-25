<?php
// Loads the meta of objects into the cache in one query and returns it by object ID; objects already cached are skipped. update_{$meta_type}_metadata_cache can answer first.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$other = wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'publish' ) );
add_metadata( 'post', $post, 'a', '1' );
add_metadata( 'post', $other, 'b', '2' );
wp_cache_delete( $post, 'post_meta' );
wp_cache_delete( $other, 'post_meta' );
$cache = update_meta_cache( 'post', array( $post, $other ) );
return array( $cache[ $post ], $cache[ $other ], wp_cache_get( $post, 'post_meta' ) === $cache[ $post ], update_meta_cache( 'post', array() ) );
